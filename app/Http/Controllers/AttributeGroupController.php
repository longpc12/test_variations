<?php

namespace App\Http\Controllers;

use App\Models\AttributeGroup;
use App\Models\Attribute;
use App\Models\Group;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    // Hiển thị danh sách nhóm thuộc tính
    public function index()
    {
        $attributeGroups = AttributeGroup::with('group', 'attribute')->get();
        return view('attribute_groups.index', compact('attributeGroups'));
    }

    // Hiển thị form tạo nhóm thuộc tính mới
    public function create()
    {
        $attributes = Attribute::all();
        $groups = Group::all();
        return view('attribute_groups.create', compact('attributes', 'groups'));
    }

    // Lưu nhóm thuộc tính mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate đầu vào
        $request->validate([
            'group_name' => 'required|string|max:255|unique:groups,name', // Kiểm tra tên nhóm thuộc tính
            'attribute_id' => 'required|array', // Xác nhận attribute_id là mảng
            'attribute_id.*' => 'exists:attributes,id', // Xác nhận các giá trị trong mảng tồn tại
        ]);

        // Tạo nhóm thuộc tính mới
        $group = Group::create([
            'name' => $request->group_name,
        ]);

        // Gắn các thuộc tính vào nhóm
        foreach ($request->attribute_id as $attributeId) {
            AttributeGroup::create([
                'group_id' => $group->id,
                'attribute_id' => $attributeId,
            ]);
        }

        return redirect()->route('attribute_groups.index')->with('success', 'Nhóm thuộc tính mới đã được tạo thành công.');
    }


    // Hiển thị form chỉnh sửa nhóm thuộc tính
    public function edit($id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id); // Tìm nhóm thuộc tính theo id
        $attributes = Attribute::all(); // Lấy tất cả các thuộc tính
        $groups = Group::all(); // Lấy tất cả các nhóm
    
        // Lấy tất cả id của thuộc tính mà nhóm hiện tại đã chọn
        $selectedAttributes = AttributeGroup::where('group_id', $attributeGroup->group_id)
                                             ->pluck('attribute_id')
                                             ->toArray();
    
        // Lấy tên của nhóm thuộc tính
        $groupName = Group::where('id', $attributeGroup->group_id)->first()->name;
    
        return view('attribute_groups.edit', compact('attributeGroup', 'attributes', 'groups', 'selectedAttributes', 'groupName'));
    }
    
    

    public function update(Request $request, $id)
    {
        // Lấy AttributeGroup cần sửa bằng ID
        $attributeGroup = AttributeGroup::findOrFail($id);
    
        // Cập nhật tên nhóm thuộc tính (vì group là một phần của bảng Group)
        $group = Group::findOrFail($attributeGroup->group_id);
        $group->name = $request->input('group_name');
        $group->save();
    
        // Cập nhật các thuộc tính đã chọn
        $selectedAttributes = $request->input('attribute_id');
        
        // Xóa tất cả thuộc tính hiện tại trong bảng attribute_groups và thêm thuộc tính mới
        AttributeGroup::where('group_id', $attributeGroup->group_id)->delete();
        foreach ($selectedAttributes as $attributeId) {
            AttributeGroup::create([
                'group_id' => $attributeGroup->group_id,
                'attribute_id' => $attributeId,
            ]);
        }
    
        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('attribute_groups.index')->with('success', 'Nhóm thuộc tính đã được cập nhật thành công.');
    }
    
    

    // Xóa nhóm thuộc tính
    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->delete();
        return redirect()->route('attribute_groups.index')->with('success', 'Nhóm thuộc tính đã được xóa.');
    }
}

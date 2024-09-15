<?php
namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttributeController extends Controller
{
    // Mảng loại thuộc tính
    private $attributeTypes = [
        0 => 'Primary',
        1 => 'Secondary',
        2 => 'Tertiary'
    ];

    public function index()
    {
        $attributes = Attribute::all();
        $attributeTypes = $this->attributeTypes;
        return view('attributes.index', compact('attributes', 'attributeTypes'));
    }

    public function create()
    {
        $attributeTypes = $this->attributeTypes;
        return view('attributes.create', compact('attributeTypes'));
    }

    public function store(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'attribute_type' => 'required|in:0,1,2', // Kiểm tra rằng attribute_type phải là 0, 1, hoặc 2
        ]);
       
        // Tạo thuộc tính mới với dữ liệu từ form
        Attribute::create([
            'name' => $request->name,
            'attribute_type' => $request->attribute_type, // Lưu attribute_type vào cơ sở dữ liệu
        ]);
    
        // Chuyển hướng về trang danh sách thuộc tính và hiển thị thông báo thành công
        return redirect()->route('attributes.index')->with('success', 'Attribute added successfully.');
    }
    
    

    

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributeTypes = $this->attributeTypes;

        return view('attributes.edit', compact('attribute', 'attributeTypes'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'attribute_type' => 'required|in:0,1,2', // Chỉ cho phép các giá trị 0, 1 hoặc 2 cho attribute_type
        ]);
    
        // Tìm attribute cần update
        $attribute = Attribute::findOrFail($id);
    
        // Cập nhật thông tin của attribute
        $attribute->update([
            'name' => $request->name,
            'attribute_type' => $request->attribute_type,
        ]);
    
        // Điều hướng về trang danh sách attribute với thông báo thành công
        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

     // Phương thức xóa thuộc tính
     public function destroy($id)
     {
         $attribute = Attribute::findOrFail($id);
 
         // Thực hiện xóa attribute
         $attribute->delete();
 
         // Điều hướng về trang danh sách thuộc tính với thông báo thành công
         return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully.');
     }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index()
    {
        $attributeValues = AttributeValue::with('attribute')->get();
        return view('attribute_values.index', compact('attributeValues'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view('attribute_values.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',  // Kiểm tra mỗi phần tử trong mảng 'values'
        ]);
    
        foreach ($request->values as $value) {
            AttributeValue::create([
                'attribute_id' => $request->attribute_id,
                'value' => $value,
            ]);
        }
    
        return redirect()->route('attribute_values.index')->with('success', 'Attribute Values added successfully');
    }
    

    // Các phương thức khác như edit, update, destroy
}

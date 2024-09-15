@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attribute List</h1>
    <a href="{{ route('attributes.create') }}" class="btn btn-primary mb-3">Add New Attribute</a>

    @if($attributes->isEmpty())
        <p>No attributes found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Attribute Type</th> <!-- Thêm cột hiển thị loại thuộc tính -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attributeTypes[$attribute->attribute_type] ?? 'No Type' }}</td> <!-- Hiển thị loại thuộc tính -->
                    <td>
                        <a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this attribute?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Attribute</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attributes.update', $attribute->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Sử dụng phương thức PUT để cập nhật -->

        <div class="form-group">
            <label for="name">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $attribute->name) }}" required>
        </div>

        <div class="form-group">
            <label for="attribute_type">Select Attribute Type</label>
            <select name="attribute_type" id="attribute_type" class="form-control" required>
                <option value="" disabled>Select Attribute Type</option>
                @foreach($attributeTypes as $key => $type)
                    <option value="{{ $key }}" {{ $attribute->attribute_type == $key ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Attribute</button>
        <a href="{{ route('attributes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

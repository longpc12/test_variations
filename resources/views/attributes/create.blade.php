@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Attribute</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attributes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="attribute_type">Select Attribute Type</label>
            <select name="attribute_type" id="attribute_type" class="form-control" required>
                <option value="" disabled selected>Select Attribute Type</option>
                <option value="0">Primary</option>
                <option value="1">Secondary</option>
                <option value="2">Tertiary</option> <!-- Loại thuộc tính thứ 3 -->
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Attribute</button>
    </form>
</div>
@endsection

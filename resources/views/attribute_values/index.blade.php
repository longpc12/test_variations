@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attribute Values List</h1>
    <a href="{{ route('attribute_values.create') }}" class="btn btn-primary mb-3">Add New Attribute Value</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Values</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributeValues->groupBy('attribute.name') as $attributeName => $values)
            <tr>
                <td rowspan="{{ count($values) }}">{{ $attributeName }}</td>
                <td>{{ $values->first()->value }}</td>
                <td>
                    <a href="{{ route('attribute_values.edit', $values->first()->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('attribute_values.destroy', $values->first()->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @foreach($values->slice(1) as $value)
            <tr>
                <td>{{ $value->value }}</td>
                <td>
                    <a href="{{ route('attribute_values.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('attribute_values.destroy', $value->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Attribute Value</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attribute_values.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="attribute_id">Select Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control">
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="value-container">
            <label for="value">Value</label>
            <div class="input-group mb-2">
                <input type="text" name="values[]" class="form-control" placeholder="Enter attribute value">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-value">Remove</button>
                </div>
            </div>
        </div>

        <button type="button" id="add-value" class="btn btn-secondary mb-3">Add Another Value</button>
        <br>
        <button type="submit" class="btn btn-success">Save Attribute Value</button>
    </form>
</div>

<script>
    document.getElementById('add-value').addEventListener('click', function () {
        var container = document.getElementById('value-container');
        var div = document.createElement('div');
        div.className = 'input-group mb-2';

        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'values[]';
        input.className = 'form-control';
        input.placeholder = 'Enter attribute value';

        var divAppend = document.createElement('div');
        divAppend.className = 'input-group-append';

        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger remove-value';
        button.textContent = 'Remove';

        divAppend.appendChild(button);
        div.appendChild(input);
        div.appendChild(divAppend);
        container.appendChild(div);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-value')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>
@endsection

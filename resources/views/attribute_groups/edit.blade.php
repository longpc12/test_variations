@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4 text-center">Sửa Nhóm Thuộc Tính</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('attribute_groups.update', $attributeGroup->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nhập tên nhóm thuộc tính -->
                    <div class="form-group mb-4">
                        <label for="group_name" class="form-label font-weight-bold">Tên nhóm thuộc tính:</label>
                        <input type="text" name="group_name" id="group_name" class="form-control border-primary shadow-sm"
                            value="{{ $groupName }}" required>
                    </div>

                    <!-- Chọn nhiều thuộc tính -->
                    <div class="form-group mb-4">
                        <label for="attribute_id" class="form-label font-weight-bold">Thuộc tính:</label>
                        <select name="attribute_id[]" id="attribute_id" class="form-select border-primary shadow-sm"
                            multiple>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}"
                                    {{ in_array($attribute->id, $selectedAttributes) ? 'selected' : '' }}>
                                    {{ $attribute->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted mt-2">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều
                            thuộc tính.</small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Cập nhật</button>

                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Tạo Nhóm Thuộc Tính Mới</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('attribute_groups.store') }}" method="POST">
                    @csrf

                    <!-- Nhập tên nhóm thuộc tính mới -->
                    <div class="form-group">
                        <label for="group_name" class="form-label font-weight-bold">Tên nhóm thuộc tính:</label>
                        <input type="text" name="group_name" id="group_name" class="form-control border-primary shadow-sm" placeholder="Nhập tên nhóm thuộc tính..." required>
                    </div>

                    <!-- Chọn nhiều thuộc tính -->
                    <div class="form-group">
                        <label for="attribute_id" class="form-label font-weight-bold">Thuộc tính:</label>
                        <select name="attribute_id[]" id="attribute_id" class="form-select border-primary shadow-sm" multiple>
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted mt-2">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều thuộc tính.</small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection

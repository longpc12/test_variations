@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4 text-center">Danh sách Nhóm Thuộc Tính</h1>
        <a href="{{ route('attribute_groups.create') }}" class="btn btn-primary mb-3">Tạo Nhóm Thuộc Tính</a>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nhóm</th>
                    <th>Thuộc tính</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentGroup = null;
                @endphp
                @foreach($attributeGroups as $attributeGroup)
                    <tr>
                        <!-- Kiểm tra nếu nhóm hiện tại khác với nhóm trước đó -->
                        @if($currentGroup != $attributeGroup->group->id)
                            @php
                                $currentGroup = $attributeGroup->group->id;
                                $rowspan = $attributeGroups->where('group_id', $attributeGroup->group->id)->count(); // Đếm số thuộc tính trong nhóm
                            @endphp
                            <td rowspan="{{ $rowspan }}">{{ $attributeGroup->group->id }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $attributeGroup->group->name }}</td>
                        @endif

                        <td>{{ $attributeGroup->attribute->name }}</td>
                        <td>
                            <a href="{{ route('attribute_groups.edit', $attributeGroup->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('attribute_groups.destroy', $attributeGroup->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

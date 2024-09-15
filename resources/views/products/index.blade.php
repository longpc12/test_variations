@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Danh Sách Sản Phẩm</h1>
        
        <!-- Nút thêm sản phẩm -->
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Thêm Sản Phẩm Mới</a>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Slug</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Biến Thể</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ number_format($product->price) }} VND</td>
                        <td>
                            @if($product->variations->isNotEmpty())
                                <ul>
                                    @foreach($product->variations as $variation)
                                        <li>
                                            Nhóm: {{ optional($variation->group)->name ?? 'Không có nhóm' }} - 
                                            Thuộc tính: {{ optional($variation->attributeValue)->value ?? 'Không có thuộc tính' }}

                                            <!-- Duyệt qua từng giá trị biến thể (variationValues) -->
                                            <ul>
                                                @foreach($variation->variationValues as $value)
                                                    <li>
                                                        Kích thước: {{ optional($value->attributeValue)->value }} - 
                                                        Giá: {{ number_format($value->price) }} VND - 
                                                        Số lượng: {{ $value->stock }} - 
                                                        Giảm giá: {{ $value->discount }}%
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Không có biến thể</p>
                            @endif
                        </td>
                        <td>
                            @if($product->variations->isNotEmpty())
                                <ul>
                                    @foreach($product->variations as $variation)
                                        <li>
                                            <strong>Ảnh đại diện:</strong>
                                            @foreach($variation->variationImages as $image)
                                                @if($image->image_type == 'thumbnail')
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail" width="100">
                                                @endif
                                            @endforeach
                                            <strong>Album:</strong>
                                            @foreach($variation->variationImages as $image)
                                                @if($image->image_type == 'album')
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Album" width="50">
                                                @endif
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Không có hình ảnh</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

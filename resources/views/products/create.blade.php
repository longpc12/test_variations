@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm sản phẩm mới</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
            @csrf
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <hr>

            <h3>Biến thể sản phẩm</h3>
            <div class="form-group">
                <label for="group_id">Chọn nhóm biến thể</label>
                <select name="group_id" id="group_id" class="form-control">
                    <option value="" disabled selected>Chọn nhóm biến thể</option>
                    @foreach ($attributeGroups as $group)
                        <option value="{{ $group->id }}"
                            data-attributes="{{ $group->attributeGroups && $group->attributeGroups->isNotEmpty() ? json_encode($group->attributeGroups->load('attribute.values')) : json_encode([]) }}">
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Container để hiển thị các thuộc tính -->
            <div id="attribute-values-container"></div>

            <button type="submit" class="btn btn-success mt-3">Lưu sản phẩm</button>
        </form>
    </div>

    <script>
        document.getElementById('group_id').addEventListener('change', function () {
            const selectedGroupId = this.value;
            const attributes = JSON.parse(this.options[this.selectedIndex].dataset.attributes || '[]');
            const container = document.getElementById('attribute-values-container');
            container.innerHTML = ''; // Xóa nội dung cũ

            if (!attributes || attributes.length === 0) {
                container.innerHTML = '<p>Không có thuộc tính cho nhóm này.</p>';
                return;
            }

            const primaryAttributes = {}; // Lưu trữ thuộc tính chính (ví dụ: Màu sắc)
            const secondaryAttributes = {}; // Lưu trữ tất cả các thuộc tính phụ (ví dụ: Kích thước)

            // Phân loại thuộc tính chính và phụ
            attributes.forEach(attributeGroup => {
                const attribute = attributeGroup.attribute;
                if (!attribute) return;

                // Nếu là thuộc tính chính (ví dụ: Màu sắc)
                if (attribute.attribute_type === 0) {
                    primaryAttributes[attribute.id] = {
                        values: attribute.values // Các giá trị (Đỏ, Xanh, Vàng...)
                    };
                } else if (attribute.attribute_type === 1) { // Nếu là thuộc tính phụ (ví dụ: Kích thước)
                    attribute.values.forEach(value => {
                        secondaryAttributes[value.id] = value.value;
                    });
                }
            });

            // Hiển thị giá trị của thuộc tính chính
            for (const primaryId in primaryAttributes) {
                let secondaryHtml = '';

                // Hiển thị tất cả giá trị của thuộc tính chính (ví dụ: Đỏ, Xanh)
                primaryAttributes[primaryId].values.forEach(primaryValue => {
                    let sizeOptions = '';
                    for (const sizeId in secondaryAttributes) {
                        sizeOptions += `
                            <div class="form-group row" id="${primaryValue.id}-${sizeId}">
                                <label class="col-sm-2 col-form-label">${secondaryAttributes[sizeId]}</label>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="variations[${primaryValue.id}][${sizeId}]" value="${secondaryAttributes[sizeId]}" class="form-check-input">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" name="variations[${primaryValue.id}][${sizeId}][stock]" placeholder="Số lượng" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" step="0.01" name="variations[${primaryValue.id}][${sizeId}][discount]" placeholder="Giảm giá (%)" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('${primaryValue.id}-${sizeId}')">X</button>
                                </div>
                            </div>
                        `;
                    }

                    secondaryHtml += `
                        <div class="attribute-block">
                            <div class="attribute-toggle" data-id="${primaryValue.id}" style="cursor: pointer; background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">
                                <span>${primaryValue.value}</span>
                                <span class="toggle-icon">+</span>
                            </div>
                            <div class="attribute-content" id="secondary-${primaryValue.id}" style="display: none;">
                                ${sizeOptions}
                                <div class="form-group">
                                    <label for="thumbnail_image_${primaryValue.id}">Hình ảnh đại diện cho ${primaryValue.value}</label>
                                    <input type="file" name="thumbnail_image_${primaryValue.id}" id="thumbnail_image_${primaryValue.id}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="album_images_${primaryValue.id}">Album hình ảnh cho ${primaryValue.value}</label>
                                    <input type="file" name="album_images_${primaryValue.id}[]" id="album_images_${primaryValue.id}" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                    `;
                });

                container.innerHTML += secondaryHtml;
            }

            // Thêm chức năng thu gọn/mở rộng
            const toggles = document.querySelectorAll('.attribute-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const content = document.getElementById(`secondary-${this.getAttribute('data-id')}`);
                    if (content.style.display === 'none' || content.style.display === '') {
                        content.style.display = 'block';
                        this.querySelector('.toggle-icon').textContent = '-';
                    } else {
                        content.style.display = 'none';
                        this.querySelector('.toggle-icon').textContent = '+';
                    }
                });
            });
        });

        // Hàm để xóa hàng
        function removeRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.remove(); // Xóa hàng khỏi giao diện
            }
        }

        // Xử lý lọc bỏ các giá trị null trước khi submit form
        document.getElementById('product-form').addEventListener('submit', function (event) {
            const form = event.target;

            // Lấy tất cả các input bắt đầu bằng "variations"
            const variationInputs = form.querySelectorAll('[name^="variations"]');

            // Lặp qua các input và xóa những cái có giá trị null hoặc rỗng
            variationInputs.forEach(input => {
                if (input.value === '' || input.value === null) {
                    input.remove();
                }
            });
        });
    </script>

    <style>
        .attribute-block {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .attribute-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .attribute-content {
            margin-top: 10px;
            display: none;
        }

        .toggle-icon {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
@endsection

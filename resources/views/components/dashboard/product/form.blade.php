<head>
    ...
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<x-dashboard.layouts.app>
    <div class="container-fluid">
        <div class="card mb-4">
            <x-dashboard.form._form
                :action="$viewMode === 'add' ? route('dashboard.products.store') : route('dashboard.products.update', $product->id)"
                :method="$viewMode === 'add' ? 'post' : 'put'"
                :indexUrl="route('dashboard.products.index')"
                :viewMode="$viewMode"
            >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input name="name" :value="$product->name"/>
                        </div>

                        <div class="form-group">
                            <x-dashboard.form._textarea name="description" :value="$product->description"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input name="SKU" :value="$product->SKU"/>
                        </div>
                        <div class="form-group required">
                            <x-dashboard.form._input name="quantity" :value="$product->quantity" type="number"/>
                        </div>
                            <div class="form-group">
                            <x-dashboard.form._select
                                name="category_id"
                                :data="$categories ?? []"
                                :value="$product->category_id"
                                :dataSelected="$product->category_id"
                            />
                        </div>
                        <div class="form-group required">
                            <x-dashboard.form._input name="discount" :value="$product->discount" type="number"/>
                        </div>
                    </div>
                </div>

                <div id="sizes-container">
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="button" id="add-size-row" class="btn btn-success">
                            <i class="fas fa-plus"></i> Добавить размер
                        </button>
                        <small class="text-muted ml-2">Максимум 8 размеров</small>
                    </div>
                </div>

            </x-dashboard.form._form>
        </div>
    </div>

    <div id="size-row-template" style="display: none;">
        <div class="size-row border p-3 mb-3" data-row-index="__index__" data-size-id="__size_id__">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="form-group required">
                        <label>Размер (например: 1600x2000)</label>
                        <x-dashboard.form._input name="sizes[__index__][size]" value="__size_value__"/>
                        <input type="hidden" name="sizes[__index__][id]" value="__size_id__">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        <label>Цена для этого размера</label>
                        <x-dashboard.form._input name="sizes[__index__][price]" type="number" value="__price_value__"/>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-danger remove-size-row">
                        <i class="fas fa-trash"></i> Удалить размер
                    </button>
                </div>
            </div>

            <div class="photo-gallery" data-config-key="product.photos" data-max="20">
                <label class="form-label d-block">Фото размера</label>
                <div class="photo-gallery-grid"></div>
                <label class="photo-dropzone">
                    <input type="file" class="photo-dropzone-input d-none" accept="image/*" multiple>
                    <div class="photo-dropzone-hint">
                        <i class="flaticon2-photo-camera"></i> Перетащите фото сюда или нажмите, чтобы выбрать
                    </div>
                </label>
                <div class="photo-gallery-error text-danger small mt-1" style="display:none"></div>
                <div class="photo-gallery-hidden-inputs"></div>
                <small class="text-muted">Можно выбрать сразу несколько фото. Перетаскивайте, чтобы изменить порядок — первое фото становится главным.</small>
            </div>
        </div>
    </div>

    <script>

        const categoriesUrl = "{{ route('dashboard.categories.list') }}";
        const existingSizes = @json($sizes ?? []);
        let currentRowCount = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeBtn = document.getElementById('add-size-row');
            const template = document.getElementById('size-row-template');

            function createSizeRow(rowIndex, sizeData = null) {
                let newRowHTML = template.innerHTML
                    .replace(/__index__/g, rowIndex);

                if (sizeData) {
                    newRowHTML = newRowHTML
                        .replace(/__size_id__/g, sizeData.id || '')
                        .replace(/__size_value__/g, sizeData.size || '')
                        .replace(/__price_value__/g, sizeData.price || '');
                } else {
                    newRowHTML = newRowHTML
                        .replace(/__size_id__/g, '')
                        .replace(/__size_value__/g, '')
                        .replace(/__price_value__/g, '');
                }

                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newRowHTML;
                return tempDiv.firstElementChild;
            }

            function addSizeRow(sizeData = null) {
                if (currentRowCount >= 8) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Максимум 8 размеров',
                        text: 'Вы достигли лимита размеров для этого продукта.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ок'
                    });
                    return;
                }

                const newRow = createSizeRow(currentRowCount, sizeData);
                sizesContainer.appendChild(newRow);
                currentRowCount++;

                initPhotoGallery(newRow.querySelector('.photo-gallery'), (sizeData && sizeData.photos) || []);
            }

            function initializeExistingSizes() {
                if (existingSizes && existingSizes.length > 0) {
                    existingSizes.forEach((size) => {
                        addSizeRow(size);
                    });
                } else {
                    addSizeRow();
                }
            }

            addSizeBtn.addEventListener('click', function() {
                addSizeRow();
            });

            sizesContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-size-row')) {
                    const row = e.target.closest('.size-row');
                    row.remove();
                    currentRowCount--;
                    reindexAllRows();
                }
            });

            function reindexAllRows() {
                const allRows = document.querySelectorAll('.size-row');
                currentRowCount = allRows.length;

                allRows.forEach((row, index) => {
                    row.dataset.rowIndex = index;

                    const sizeInput = row.querySelector('input[name*="[size]"]');
                    const priceInput = row.querySelector('input[name*="[price]"]');
                    const idInput = row.querySelector('input[name*="[id]"]');

                    if (sizeInput) sizeInput.name = `sizes[${index}][size]`;
                    if (priceInput) priceInput.name = `sizes[${index}][price]`;
                    if (idInput) idInput.name = `sizes[${index}][id]`;

                    window.reserializePhotoGalleries(row);
                });
            }

            initializeExistingSizes();
        });
    </script>

    <style>
        .photo-gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .photo-thumb {
            position: relative;
            width: 110px;
            height: 110px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            cursor: grab;
            background: #f8fafc;
        }

        .photo-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-thumb.is-dragging {
            opacity: 0.4;
        }

        .photo-thumb.is-pending img {
            opacity: 0.5;
        }

        .photo-thumb-spinner {
            display: none;
            position: absolute;
            inset: 0;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.25);
        }

        .photo-thumb.is-pending .photo-thumb-spinner {
            display: flex;
        }

        .photo-thumb-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            border: 0;
            border-radius: 50%;
            background: rgba(220, 53, 69, 0.9);
            color: #fff;
            font-size: 11px;
            line-height: 1;
            padding: 0;
        }

        .photo-dropzone {
            display: block;
            border: 2px dashed #cbd5e1;
            border-radius: 6px;
            padding: 16px;
            text-align: center;
            color: #64748b;
            cursor: pointer;
            margin-bottom: 0;
        }

        .photo-dropzone.is-dragover {
            border-color: #3085d6;
            background: #f0f7ff;
            color: #3085d6;
        }
    </style>

    <x-slot name="scripts">
        <script src="{{ asset('/js/dashboard/product/main.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.app>

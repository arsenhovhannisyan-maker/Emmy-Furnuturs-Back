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
                                :data="[]"
                                :value="$product->category_id"
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

                <div class="all-photo-components">
                    @for($i = 1; $i <= 48; $i++)
                        <div class="photo-component-container" id="photo-container-{{ $i }}" style="display: none;">
                            <x-dashboard.form.uploader._file
                                name="photo{{ $i }}"
                                :value="$product->{'photo'.$i} ?? null"
                                :configKey="$product->getFileConfigName()"
                            />
                        </div>
                    @endfor
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

            <div class="photos-row mt-2" data-start-photo="__start_photo__">
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <button type="button" class="btn btn-outline-primary add-photo-btn">
                        <i class="fas fa-plus"></i> Oткрыть или Добавить фото
                    </button>
                    <small class="text-muted ml-2">Максимум 6 фото на размер</small>
                </div>
            </div>
        </div>
    </div>

    <script>

        const categoriesUrl = "{{ route('dashboard.categories.list') }}";
        const existingSizes = @json($sizes ?? []); 
        let currentRowCount = 0;
        let availablePhotos = Array.from({length: 48}, (_, i) => i + 1);

        document.addEventListener('DOMContentLoaded', function() {
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeBtn = document.getElementById('add-size-row');
            const template = document.getElementById('size-row-template');
            const allPhotoComponents = document.querySelector('.all-photo-components');

            function getStartPhotoForRow(rowIndex) {
                return (rowIndex * 6) + 1;
            }

            function moveContainerToPool(container) {
                if (!container || !allPhotoComponents) return;
                const num = container.id.replace('photo-container-', '');
                if (num && !availablePhotos.includes(parseInt(num, 10))) {
                    availablePhotos.push(parseInt(num, 10));
                    availablePhotos.sort((a, b) => a - b);
                }
                container.style.display = 'none';
                allPhotoComponents.appendChild(container);
            }

            function createSizeRow(rowIndex, sizeData = null) {
                const startPhoto = getStartPhotoForRow(rowIndex);
                let newRowHTML = template.innerHTML
                    .replace(/__index__/g, rowIndex)
                    .replace(/__start_photo__/g, startPhoto);

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
            }

            function initializeExistingSizes() {
                if (existingSizes && existingSizes.length > 0) {
                    existingSizes.forEach((size, index) => {
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
                    hideAllPhotosInRow(row);
                    row.remove();
                    currentRowCount--;
                    reindexAllRows();
                    return;
                }

                if (e.target.closest('.add-photo-btn')) {
                    const row = e.target.closest('.size-row');
                    const photosRow = row.querySelector('.photos-row');
                    addPhotoInput(photosRow);
                    return;
                }

                if (e.target.closest('.remove-photo')) {
                    const photoItem = e.target.closest('.photo-item');
                    const container = getContainerFromPhotoItem(photoItem);
                    if (container) moveContainerToPool(container);
                    photoItem.remove();
                    return;
                }
            });

            function getContainerFromPhotoItem(photoItem) {
                const wrap = photoItem.querySelector('.current-photo-container');
                return wrap ? wrap.querySelector('.photo-component-container') : null;
            }

            function hidePhotoComponent(photoNumber) {
                const container = document.getElementById('photo-container-' + photoNumber);
                if (container) {
                    moveContainerToPool(container);
                }
            }

            function hideAllPhotosInRow(row) {
                const photoItems = row.querySelectorAll('.photo-item');
                photoItems.forEach(item => {
                    const container = getContainerFromPhotoItem(item);
                    if (container) moveContainerToPool(container);
                });
            }

            function addPhotoInput(photosRow) {
                const currentPhotos = photosRow.querySelectorAll('.photo-item').length;
                const startPhoto = parseInt(photosRow.dataset.startPhoto);
                const currentPhotoNumber = startPhoto + currentPhotos;

                if (currentPhotos >= 6) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Максимум 6 фото',
                        text: 'На один размер можно добавить не более 6 фото.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ок'
                    });
                    return;
                }

                if (currentPhotoNumber > 48) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Превышен лимит фото',
                        text: 'Вы не можете использовать более 48 фото для всех размеров.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Ок'
                    });
                    return;
                }

                const photoCol = document.createElement('div');
                photoCol.className = 'photo-item d-inline-block mr-3 mb-3';
                photoCol.dataset.photoNumber = currentPhotoNumber;

                photoCol.innerHTML = `
                    <div class="form-group" style="min-width: 200px;">
                        <label class="form-label">Фото ${currentPhotoNumber}</label>
                        <div class="current-photo-container"></div>
                        <button type="button" class="btn btn-sm btn-danger mt-2 remove-photo">
                            <i class="fas fa-times"></i> Удалить
                        </button>
                    </div>
                `;

                photosRow.appendChild(photoCol);

                var container = document.getElementById('photo-container-' + currentPhotoNumber);
                if (container && allPhotoComponents) {
                    var index = availablePhotos.indexOf(currentPhotoNumber);
                    if (index > -1) availablePhotos.splice(index, 1);
                    var target = photoCol.querySelector('.current-photo-container');
                    if (target) {
                        target.appendChild(container);
                        container.style.display = 'block';
                    }
                }
            }

            function reindexAllRows() {
                const allRows = document.querySelectorAll('.size-row');
                currentRowCount = allRows.length;

                allRows.forEach((row, index) => {
                    const startPhoto = getStartPhotoForRow(index);
                    const photosRow = row.querySelector('.photos-row');
                    photosRow.dataset.startPhoto = startPhoto;

                    const sizeInput = row.querySelector('input[name*="[size]"]');
                    const priceInput = row.querySelector('input[name*="[price]"]');
                    const idInput = row.querySelector('input[name*="[id]"]');

                    if (sizeInput) sizeInput.name = `sizes[${index}][size]`;
                    if (priceInput) priceInput.name = `sizes[${index}][price]`;
                    if (idInput) idInput.name = `sizes[${index}][id]`;

                    const photoItems = photosRow.querySelectorAll('.photo-item');
                    photoItems.forEach((item) => {
                        const container = getContainerFromPhotoItem(item);
                        const actualNum = container ? container.id.replace('photo-container-', '') : '';
                        if (actualNum) {
                            const label = item.querySelector('label');
                            if (label) label.textContent = 'Фото ' + actualNum;
                            item.dataset.photoNumber = actualNum;
                        }
                    });
                });
            }

            initializeExistingSizes();
        });
    </script>

    <style>
        .photos-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-start;
        }

        .photo-item {
            flex: 0 0 auto;
        }

        .photo-item .form-group {
            margin-bottom: 0;
        }
    </style>

    <x-slot name="scripts">
        <script src="{{ asset('/js/dashboard/product/main.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.app>

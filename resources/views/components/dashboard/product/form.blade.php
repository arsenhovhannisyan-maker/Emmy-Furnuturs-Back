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
            <div class="row align-items-end">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Как описать размер</label>
                        <select class="form-control size-mode-select">
                            <option value="text">Одна строка</option>
                            <option value="dimensions">По размерам (В×Ш×Г)</option>
                        </select>
                        <input type="hidden" name="sizes[__index__][mode]" value="text" class="size-mode-input">
                        <input type="hidden" name="sizes[__index__][id]" value="__size_id__">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        <label class="control-label">Цена для этого размера</label>
                        <x-dashboard.form._input name="sizes[__index__][price]" type="number" value="__price_value__" title="Цена" :noLabel="true"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Сторона</label>
                        <select class="form-control size-orientation-select" name="sizes[__index__][orientation]">
                            <option value="">Без стороны</option>
                            <option value="left">Слева</option>
                            <option value="right">Справа</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-danger remove-size-row">
                        <i class="fas fa-trash"></i> Удалить размер
                    </button>
                </div>
            </div>

            <div class="row size-text-group">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label">Размер (например: 1600x2000)</label>
                        <x-dashboard.form._input name="sizes[__index__][size]" value="__size_value__" title="Размер" :noLabel="true"/>
                    </div>
                </div>
            </div>

            <div class="row size-dimensions-group" style="display:none;">
                <div class="col-md-4">
                    <div class="form-group required">
                        <label class="control-label">Высота</label>
                        <x-dashboard.form._input name="sizes[__index__][height]" value="__height_value__" title="Высота" :noLabel="true"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        <label class="control-label">Ширина</label>
                        <x-dashboard.form._input name="sizes[__index__][width]" value="__width_value__" title="Ширина" :noLabel="true"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        <label class="control-label">Глубина</label>
                        <x-dashboard.form._input name="sizes[__index__][depth]" value="__depth_value__" title="Глубина" :noLabel="true"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Характеристики этого размера</label>
                <textarea class="form-control size-characteristics" name="sizes[__index__][characteristics]"></textarea>
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

            // The row template is built by string-replacing placeholders directly into
            // an HTML string, then assigned via innerHTML - values must be HTML-escaped
            // first or admin-typed text containing a quote/angle-bracket could break out
            // of the value="..." attribute and inject markup (stored XSS in the dashboard).
            function escapeHtml(value) {
                const div = document.createElement('div');
                div.textContent = String(value);
                return div.innerHTML;
            }

            function createSizeRow(rowIndex, sizeData = null) {
                let newRowHTML = template.innerHTML
                    .replace(/__index__/g, rowIndex);

                const d = sizeData || {};
                newRowHTML = newRowHTML
                    .replace(/__size_id__/g, escapeHtml(d.id || ''))
                    .replace(/__size_value__/g, escapeHtml(d.size || ''))
                    .replace(/__price_value__/g, escapeHtml(d.price || ''))
                    .replace(/__height_value__/g, escapeHtml(d.height || ''))
                    .replace(/__width_value__/g, escapeHtml(d.width || ''))
                    .replace(/__depth_value__/g, escapeHtml(d.depth || ''));

                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newRowHTML;
                return tempDiv.firstElementChild;
            }

            function applySizeMode(row, mode) {
                const isDimensions = mode === 'dimensions';
                row.querySelector('.size-mode-select').value = isDimensions ? 'dimensions' : 'text';
                row.querySelector('.size-mode-input').value = isDimensions ? 'dimensions' : 'text';
                row.querySelector('.size-text-group').style.display = isDimensions ? 'none' : '';
                row.querySelector('.size-dimensions-group').style.display = isDimensions ? '' : 'none';
            }

            function clearGroupInputs(row, groupSelector) {
                row.querySelector(groupSelector).querySelectorAll('input').forEach((input) => {
                    input.value = '';
                });
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

                applySizeMode(newRow, (sizeData && sizeData.mode) || 'text');
                newRow.querySelector('.size-orientation-select').value = (sizeData && sizeData.orientation) || '';

                const characteristics = newRow.querySelector('.size-characteristics');
                characteristics.value = (sizeData && sizeData.characteristics) || '';
                ClassicEditor.create(characteristics, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'undo', 'redo'],
                    table: { contentToolbar: ['tableColumn', 'tableRow'] },
                }).then((editor) => {
                    editor.model.document.on('change:data', () => editor.updateSourceElement());
                }).catch(console.error);

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

            sizesContainer.addEventListener('change', function(e) {
                if (e.target.classList.contains('size-mode-select')) {
                    const row = e.target.closest('.size-row');
                    const mode = e.target.value;
                    applySizeMode(row, mode);
                    // Clear BOTH groups, not just the one being hidden: the one being
                    // shown may still be holding whatever was hydrated for the OTHER
                    // mode when this row was first loaded (e.g. switching dimensions ->
                    // text would otherwise leave the now-visible text field pre-filled
                    // with the old composed "В..хШ..хГ.." label instead of starting blank).
                    clearGroupInputs(row, '.size-text-group');
                    clearGroupInputs(row, '.size-dimensions-group');
                }
            });

            const SIZE_ROW_FIELDS = ['size', 'price', 'id', 'height', 'width', 'depth', 'orientation', 'mode', 'characteristics'];

            function reindexAllRows() {
                const allRows = document.querySelectorAll('.size-row');
                currentRowCount = allRows.length;

                allRows.forEach((row, index) => {
                    row.dataset.rowIndex = index;

                    SIZE_ROW_FIELDS.forEach((field) => {
                        const input = row.querySelector(`[name*="[${field}]"]`);
                        if (input) input.name = `sizes[${index}][${field}]`;
                    });

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

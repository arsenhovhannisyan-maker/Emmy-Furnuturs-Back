<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>

<!-- Grid Gallery-->
    <section class="section section-md bg-default">
        <div class="container-fluid isotope-wrap isotope-custom-2">
            <div class="isotope-filters">
                <button class="isotope-filters-toggle button button-sm button-icon button-icon-right button-default-outline" data-custom-toggle=".isotope-filters-list" data-custom-toggle-disable-on-blur="true" data-custom-toggle-hide-on-blur="true"><span class="icon mdi mdi-chevron-down"></span>@lang('messages.filter')</button>
                <div class="isotope-filters-list-wrap">
                    <ul class="isotope-filters-list">
                        <li><a class="active" href="#" data-isotope-filter="*">@lang('messages.view_all')</a></li>
                        <li><a href="#" data-isotope-filter="Type 1">@lang('messages.furnitures')</a></li>
                        <li><a href="#" data-isotope-filter="Type 2">@lang('messages.other_pastry')</a></li>
                    </ul>
                </div>
            </div>
            <div class="row row-30 isotope gallery-custom" data-lightgallery="group" id="gallery-products" style="display: flex">
                <!-- Products will be loaded here -->
                <div class="col-12 text-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">@lang('messages.loading')</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const BaseUrlProduct = "{{ url('/product') }}";

        document.addEventListener('DOMContentLoaded', async function () {
            let iso = null;
            const grid = document.querySelector('.isotope');
            const galleryContainer = document.getElementById('gallery-products');

            if (grid) {
                iso = new Isotope(grid, {
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows'
                });
            }

            galleryContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">@lang('messages.loading')</span>
                    </div>
                </div>
            `;

            try {
                const response = await axios.get('{{ url('/products/get-eight') }}');
                const data = response.data;
                const products = Array.isArray(data)
                    ? data.slice(0, 6)
                    : Array.isArray(data.data)
                        ? data.data.slice(0, 6)
                        : [];

                if (products.length === 0) {
                    galleryContainer.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p>@lang('messages.no_products_available')</p>
                        </div>
                    `;
                    return;
                }

                let html = '';
                products.forEach((product, index) => {
                    const productImage = product.photo1 ? product.photo1.file_url : '/images/no-image.png';
                    const productName = product.name || 'Product';
                    const productPrice = product.price ? '$' + parseFloat(product.price).toFixed(2) : '$0.00';
                    const productId = product.id;
                    const filterType = index % 2 === 0 ? 'Type 1' : 'Type 2';

                    html += `
                        <div class="col-sm-6 col-md-6 col-xl-4 isotope-item gallery-positions" data-filter="${filterType}"  >
                            <article class="thumbnail-classic block-1">
                                <div class="thumbnail-classic-figure">
                                    <img src="${productImage}" alt="${productName}" width="370" height="315"
                                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'370\' height=\'315\'%3E%3Crect fill=\'%23f0f0f0\' width=\'370\' height=\'315\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-family=\'sans-serif\' font-size=\'16\'%3ENo image%3C/text%3E%3C/svg%3E'"/>
                                </div>
                                <div class="thumbnail-classic-caption">
                                    <div>
                                        <h5 class="thumbnail-classic-title">
                                            <a href="${BaseUrlProduct}/${productId}">${productName}</a>
                                        </h5>
                                        <div class="thumbnail-classic-price">${productPrice}</div>
                                        <div class="thumbnail-classic-button-wrap">
                                            <div class="thumbnail-classic-button">
                                                <a class="button button-gray-6 button-zakaria fl-bigmug-line-search74"
                                                     href="${BaseUrlProduct}/${productId}">
                                                    <img src="${productImage}" alt="${productName}" width="370" height="315"/>
                                                </a>
                                            </div>
                                            <div class="thumbnail-classic-button">
                                                <a class="button button-secondary-3 button-zakaria fl-bigmug-line-shopping202"
                                                    href="/basket"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>`;
                });

                galleryContainer.innerHTML = html;

                if (iso) {
                    imagesLoaded(grid, function () {
                        iso.reloadItems();
                        iso.arrange();
                    });
                }

            } catch (error) {
                console.error('❌ @lang('messages.gallery_load_error'):', error);
                galleryContainer.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <p>@lang('messages.gallery_error_message')</p>
                    </div>
                `;
            }
        });
    </script>
<style>
    .gallery-positions{
        position: static !important;
    }
</style>

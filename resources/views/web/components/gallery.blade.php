<!-- Grid Gallery-->
    <section class="section section-md bg-default">
        <div class="container-fluid gallery-section-wrap">
            <div class="row row-30 gallery-custom" id="gallery-products">
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
        const BaseUrlProduct = "{{ rtrim(route('web.product', ['id' => 1]), '1') }}";

        document.addEventListener('DOMContentLoaded', async function () {
            const galleryContainer = document.getElementById('gallery-products');

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
                products.forEach((product) => {
                    const productImage = product.photo1 ? product.photo1.file_url : '/images/no-image.png';
                    const productName = product.name || 'Product';
                    const productPrice = product.price ? parseFloat(product.price).toFixed(2) + ' руб.' : '$0.00 руб.';
                    const productId = product.id;

                    html += `
                        <div class="col-sm-6 col-md-6 col-xl-4">
                            <article class="thumbnail-classic block-1">
                                <div class="thumbnail-classic-figure">
                                    <img src="${productImage}" alt="${productName}" width="370" height="315"
                                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'370\' height=\'315\'%3E%3Crect fill=\'%23f0f0f0\' width=\'370\' height=\'315\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-family=\'sans-serif\' font-size=\'16\'%3ENo image%3C/text%3E%3C/svg%3E'"/>
                                </div>
                                <div class="thumbnail-classic-caption">
                                    <div>
                                        <h5 class="thumbnail-classic-title">
                                            <a href="${BaseUrlProduct}${productId}">${productName}</a>
                                        </h5>
                                        <div class="thumbnail-classic-price">${productPrice}</div>
                                        <div class="thumbnail-classic-button-wrap">
                                            <div class="thumbnail-classic-button">
                                                <a class="button button-gray-6 button-zakaria gallery-btn-view"
                                                     href="${BaseUrlProduct}${productId}" title="@lang('messages.view')">
                                                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="thumbnail-classic-button">
                                                <a class="button button-secondary-3 button-zakaria gallery-btn-cart"
                                                    href="/basket" title="@lang('messages.cart_page')">
                                                    <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>`;
                });

                galleryContainer.innerHTML = html;

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
    .thumbnail-classic-button-wrap .gallery-btn-view i,
    .thumbnail-classic-button-wrap .gallery-btn-cart i {
        font-size: 1.1rem;
        color: inherit;
    }
    .thumbnail-classic-button-wrap .gallery-btn-cart i {
        color: #fff;
    }
    /* Plain CSS grid, no JS-driven masonry: layout is computed synchronously by the
       browser on every load, so it can never render mid-calculation or race with
       async data/image loading (that was the source of the gallery jumping on top
       of neighboring sections after a cached/instant reload). */
    #gallery-products {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .thumbnail-classic {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .thumbnail-classic-figure {
        aspect-ratio: 4 / 5;
        overflow: hidden;
    }
    .thumbnail-classic-figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .thumbnail-classic-caption {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
    }
    .thumbnail-classic-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.35;
        min-height: 2.7em;
    }
    .gallery-section-wrap {
        margin-top: 30px;
    }
    @media (min-width: 768px) {
        .gallery-section-wrap {
            margin-top: 44px;
        }
    }
    @media (min-width: 992px) {
        .desktop .gallery-section-wrap {
            padding-left: 0;
            padding-right: 0;
        }
        .desktop .gallery-section-wrap .row {
            margin-right: 0;
            margin-left: 0;
            margin-bottom: 0;
        }
        .desktop .gallery-section-wrap .row > [class*="col-"] {
            padding-right: 0;
            padding-left: 0;
            margin-bottom: 0;
        }
    }
</style>

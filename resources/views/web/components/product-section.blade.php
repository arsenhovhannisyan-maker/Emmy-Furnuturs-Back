<section class="section section-md bg-primary-2">
    <div class="container">
        <h2 class="text-transform-capitalize wow fadeScale">@lang('messages.our_products')</h2>
        <div id="products-container" class="row row-lg row-30 row-lg-30">
        </div>
    </div>
</section>

<script>
    const productBaseUrl = "{{ rtrim(route('web.product', ['id' => 1]), '1') }}";
    const cardUrl = productBaseUrl;
</script>

<script>
    async function fetchProducts() {
        try {
            const response = await fetch("{{ route('web.getEightProducts') }}");
            const data = await response.json();
            const container = document.getElementById('products-container');
            container.innerHTML = '';

            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = '<div class="col-12 text-center"><p>@lang('messages.no_products_available')</p></div>';
                return;
            }

            data.forEach((product, index) => {
                const delay = (index * 0.1).toFixed(1);
                const discount = Number(product.discount) || 0;
                const basePrice = Number(product.price) || 0;
                const hasDiscount = discount > 0;
                const finalPrice = hasDiscount ? Math.max(0, basePrice - discount) : basePrice;
                const oldPriceRow = hasDiscount
                    ? `<div class="product-price product-price-old">${basePrice} руб.</div>`
                    : '';
                const html = `
  <div class="col-sm-6 col-md-4 col-lg-3">
    <article class="product wow fadeInRight" data-wow-delay=".${delay}s">
      <div class="product-body">
        <div class="product-figure">
          <img
            src="${product.photo1 ? product.photo1.file_url : '/images/no-image.png'}"
            alt="${product.name}"
            width="148"
            height="128"
          />
        </div>

        <h5 class="product-title">
          <a href="${productBaseUrl}${product.id}">${product.name}</a>
        </h5>

        <div class="product-price-wrap">
          ${oldPriceRow}
          <div class="product-price">${finalPrice} руб.</div>
        </div>
      </div>

      <div class="product-button-wrap">
        <div class="product-button">
          <a class="button button-gray-14 button-zakaria ch-navbar-basket fas ch-navbar-search-toggle fas fa-search fa-2x"
             href="${productBaseUrl}${product.id}"
             title="@lang('messages.view_details')"></a>
        </div>
        <div class="product-button">
          <a class="button button-primary-2 button-zakaria ch-navbar-basket fas fa-shopping-cart"
             href="${cardUrl}${product.id}"
             title="@lang('messages.add_to_cart')"></a>
        </div>
      </div>
    </article>
  </div>
`;
                container.insertAdjacentHTML('beforeend', html);
            });

        } catch (error) {
            console.error(error);
            const container = document.getElementById('products-container');
            container.innerHTML = '<div class="col-12 text-center"><p>@lang('messages.loading_error')</p></div>';
        }
    }

    document.addEventListener('DOMContentLoaded', fetchProducts);
</script>

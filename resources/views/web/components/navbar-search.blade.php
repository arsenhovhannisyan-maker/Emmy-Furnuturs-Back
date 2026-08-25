<style>
    /* Live search container */
    .ch-search-results-live {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #ddd;
        width: 100%;
        max-height: 350px;
        overflow-y: auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        z-index: 999;
        padding: 10px;
        font-family: 'Arial', sans-serif;
        display: none; /* Hidden by default */
    }

    .ch-search-results-live.active {
        display: block; /* Show when active */
    }

    /* List reset */
    .search-results-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    /* Each product item as a card */
    .search-result-item {
        display: flex;
        align-items: center;
        padding: 8px;
        border-radius: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        background: #fff;
        border: 1px solid #eee;
    }

    /* Hover effect */
    .search-result-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background: #f9f9ff;
    }

    /* Product image */
    .search-result-item img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        background-color: #ffffff;
        border-radius: 8px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    /* Product name and price */
    .search-result-link {
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .search-result-link strong {
        font-size: 14px;
    }

    .search-result-link small {
        font-size: 13px;
        color: #888;
        margin-left: auto;
    }

    /* No results */
    .no-results {
        text-align: center;
        color: #999;
        font-size: 14px;
        padding: 12px 0;
    }

    /* Scrollbar styling */
    .ch-search-results-live::-webkit-scrollbar {
        width: 6px;
    }

    .ch-search-results-live::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 3px;
    }

    /* Form positioning */
    .ch-navbar-search {
        position: relative;
    }

    .form-wrap {
        position: relative;
    }
</style>

<div class="ch-navbar-search ch-navbar-search-2">
    <button class="ch-navbar-search-toggle fas fa-search fa-2x" data-ch-navbar-toggle=".ch-navbar-search"></button>
    <form class="ch-search" action="{{ route('products.search') }}" method="GET">
        <div class="form-wrap">
            <input class="ch-navbar-search-form-input form-input" id="ch-navbar-search-form-input" type="text" name="s" autocomplete="off"/>
            <label class="form-label" for="ch-navbar-search-form-input">@lang('messages.search_placeholder')</label>
            <div class="ch-search-results-live" id="ch-search-results-live"></div>
            <button class="ch-search-form-submit fl-bigmug-line-search74" type="submit"></button>
        </div>
    </form>
</div>

<script>
    (function() {
        const input = document.querySelector('#ch-navbar-search-form-input');
        const resultsContainer = document.querySelector('#ch-search-results-live');
        const searchUrl = "{{ route('products.search') }}";
        const productBaseUrl = "{{ url('dashboard/product') }}"; // Fixed URL

        let timer = null;

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
                resultsContainer.classList.remove('active');
            }
        });

        input.addEventListener('input', function () {
            const query = this.value.trim();
            clearTimeout(timer);

            if (query.length < 2) {
                resultsContainer.innerHTML = '';
                resultsContainer.classList.remove('active');
                return;
            }

            timer = setTimeout(() => {
                fetch(`${searchUrl}?s=${encodeURIComponent(query)}`)
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return res.json();
                    })
                    .then(products => {
                        resultsContainer.innerHTML = '';

                        if (products.length === 0) {
                            resultsContainer.innerHTML = '<div class="no-results">@lang('messages.no_products_found')</div>';
                        } else {
                            const list = document.createElement('ul');
                            list.classList.add('search-results-list');

                            products.forEach(product => {
                                const item = document.createElement('li');
                                item.classList.add('search-result-item');
                                console.log(product);
                                // Generate proper image URL
                                const imageUrl = product.image
                                    ? `{{ asset('') }}/${product.image}`
                                    : null;

                                // Generate product URL
                                const productUrl = `${productBaseUrl}/${product.id}`;

                                item.innerHTML = `
                                    <a href="${productUrl}" class="search-result-link">
                                        <img src="${imageUrl}" alt="${product.name}">
                                        <strong>${product.name}</strong>
                                        <small>$${Number(product.price).toFixed(2)}</small>
                                    </a>
                                `;

                                list.appendChild(item);
                            });

                            resultsContainer.appendChild(list);
                        }

                        resultsContainer.classList.add('active');
                    })
                    .catch(err => {
                        console.error('Search error:', err);
                        resultsContainer.innerHTML = '<div class="no-results">@lang('messages.search_error')</div>';
                        resultsContainer.classList.add('active');
                    });
            }, 300);
        });

        // Show results on focus if there's content
        input.addEventListener('focus', function() {
            if (resultsContainer.innerHTML.trim() !== '') {
                resultsContainer.classList.add('active');
            }
        });
    })();
</script>

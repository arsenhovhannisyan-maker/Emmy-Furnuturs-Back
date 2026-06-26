<style>
    .post-classic-figure {
        height: 220px;
        display: block;
        overflow: hidden;
    }
    .post-classic-figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        -webkit-transform: none;
        transform: none;
        will-change: auto;
    }
    @supports (-webkit-touch-callout: none) {
        .post-classic-figure img {
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
        }
    }
</style>

<section class="section section-md bg-primary-2">
    <div class="container">
        <h2 class="text-transform-capitalize wow fadeScale">@lang('messages.our_blog')</h2>

        <div id="blog-carousel"
             class="owl-carousel"
             data-items="1"
             data-sm-items="2"
             data-lg-items="3"
             data-margin="30"
             data-dots="true"
             data-mouse-drag="false">
        </div>
    </div>
</section>

<script>
    const singleBlogBaseUrl = "{{ url('/single-blog') }}";

    async function fetchBlogs() {
        const container = $('#blog-carousel');
        container.html(`
            <article class="post post-classic box-md wow fadeIn text-center text-light">
                <p>@lang('messages.loading_blogs')</p>
            </article>
        `);

        try {
            const response = await fetch("{{ route('web.getLatestBlogs') }}");
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            const data = await response.json();

            if (container.hasClass('owl-loaded')) {
                container.trigger('destroy.owl.carousel');
                container.html('');
                container.removeClass('owl-loaded owl-hidden');
            } else {
                container.html('');
            }

            // Если нет блогов
            if (!data || data.length === 0) {
                container.html(`
                    <article class="post post-classic box-md wow fadeIn text-center">
                        <p>@lang('messages.no_blogs')</p>
                    </article>
                `);
                return;
            }

            data.forEach((blog, index) => {
                const delayClass = index % 2 === 0 ? 'slideInDown' : 'slideInUp';
                const imageUrl = blog.photo || '/images/blog/blog-home-1.jpg';
                const date = blog.created_at_formatted || '';
                const text = blog.shortDescription || (blog.description ? blog.description.substring(0, 150) + '...' : '');

                const html = `
                    <!-- Post Classic -->
                    <article class="post post-classic box-md wow ${delayClass}">
                        <a class="post-classic-figure" href="${singleBlogBaseUrl}/${blog.id}">
                            <img src="${imageUrl}" alt="${blog.name}" />
                        </a>
                        <div class="post-classic-content">
                            <div class="post-classic-time">
                                <time datetime="${date}">${date}</time>
                            </div>
                            <h4 class="post-classic-title">
                                <a href="${singleBlogBaseUrl}/${blog.id}">${blog.name}</a>
                            </h4>
                            <p class="post-classic-text">${text}</p>
                        </div>
                    </article>
                `;
                container.append(html);
            });

            container.owlCarousel({
                items: 1,
                margin: 30,
                dots: true,
                mouseDrag: false,
                responsive: {
                    576: { items: 2 },
                    992: { items: 3 }
                }
            });

        } catch (error) {
            console.error('@lang('messages.blogs_load_error'):', error);
            container.html(`
                <article class="post post-classic box-md wow fadeIn text-center text-danger">
                    <p>@lang('messages.failed_load_blogs')</p>
                </article>
            `);
        }
    }

    document.addEventListener('DOMContentLoaded', fetchBlogs);
</script>

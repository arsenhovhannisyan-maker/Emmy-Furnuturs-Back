<!-- Social Media Sharing Component -->
<div class="group-xs group-middle" itemscope itemtype="https://schema.org/ShareAction">
    <span class="list-social-title">@lang('messages.share')</span>
    <div>
        <ul class="list-inline list-social list-inline-sm">
            <!-- Facebook -->
            <li itemprop="instrument" itemscope itemtype="https://schema.org/ChooseAction">
                <a class="icon fab fa-facebook-f"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   onclick="trackSocialShare('facebook')"
                   title="Поделиться в Facebook"
                   aria-label="Поделиться в Facebook"
                   itemprop="actionOption">
                    <meta itemprop="name" content="Поделиться в Facebook">
                </a>
            </li>

            <!-- Twitter -->
            <li itemprop="instrument" itemscope itemtype="https://schema.org/ChooseAction">
                <a class="icon fab fa-twitter"
                   href="https://twitter.com/intent/tweet?url={{ rawurlencode(url()->current()) }}&text={{ rawurlencode(__('messages.seo_twitter_share_text')) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   onclick="trackSocialShare('twitter')"
                   title="Поделиться в Twitter"
                   aria-label="Поделиться в Twitter"
                   itemprop="actionOption">
                    <meta itemprop="name" content="Поделиться в Twitter">
                </a>
            </li>

            <!-- Instagram -->
            <li itemprop="instrument" itemscope itemtype="https://schema.org/ChooseAction">
                <a class="icon fab fa-instagram"
                   href="https://www.instagram.com/"
                   target="_blank"
                   rel="noopener noreferrer"
                   onclick="trackSocialShare('instagram')"
                   title="Перейти в Instagram"
                   aria-label="Перейти в Instagram"
                   itemprop="actionOption">
                    <meta itemprop="name" content="Перейти в Instagram">
                </a>
            </li>

            <!-- Pinterest -->
            <li itemprop="instrument" itemscope itemtype="https://schema.org/ChooseAction">
                <a class="icon fab fa-pinterest"
                   href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   onclick="trackSocialShare('pinterest')"
                   title="Сохранить в Pinterest"
                   aria-label="Сохранить в Pinterest"
                   itemprop="actionOption">
                    <meta itemprop="name" content="Сохранить в Pinterest">
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    function trackSocialShare(network) {
        // Отслеживание социальных шаров для аналитики
        if (typeof gtag !== 'undefined') {
            gtag('event', 'share', {
                'event_category': 'social',
                'event_label': network,
                'transport_type': 'beacon'
            });
        }

        // Копируем ссылку в буфер обмена как резервный вариант
        navigator.clipboard.writeText(window.location.href)
            .then(() => {
                console.log("URL copied to clipboard");
                showNotification('@lang('messages.url_copied')');
            })
            .catch(err => {
                console.error("Copy to clipboard failed", err);
                // Fallback для старых браузеров
                fallbackCopyToClipboard();
            });
    }

    function fallbackCopyToClipboard() {
        const textArea = document.createElement("textarea");
        textArea.value = window.location.href;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            showNotification('@lang('messages.url_copied')');
        } catch (err) {
            console.error('Fallback copy failed', err);
            showNotification('@lang('messages.copy_failed')');
        }

        document.body.removeChild(textArea);
    }

    function showNotification(message) {
        // Удаляем существующие уведомления
        const existingNotifications = document.querySelectorAll('.social-share-notification');
        existingNotifications.forEach(notification => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        });

        const notification = document.createElement('div');
        notification.className = 'social-share-notification';
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: socialNotificationSlideIn 0.3s ease-out;
        `;

        notification.textContent = message;
        notification.setAttribute('role', 'alert');
        notification.setAttribute('aria-live', 'polite');

        // Добавляем CSS анимацию если её еще нет
        if (!document.querySelector('#social-notification-styles')) {
            const style = document.createElement('style');
            style.id = 'social-notification-styles';
            style.textContent = `
                @keyframes socialNotificationSlideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes socialNotificationSlideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.style.animation = 'socialNotificationSlideOut 0.3s ease-out';
                setTimeout(() => {
                    if (notification.parentNode) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }
        }, 3000);
    }

    // Инициализация микроразметки при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        // Добавляем микроразметку для социальных кнопок
        const socialContainer = document.querySelector('.group-xs.group-middle');
        if (socialContainer) {
            socialContainer.setAttribute('itemscope', '');
            socialContainer.setAttribute('itemtype', 'https://schema.org/ShareAction');
        }
    });
</script>

<style>
    .list-social a {
        transition: all 0.3s ease;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
    }

    .list-social a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .list-social .fa-facebook-f:hover { background: #3b5998; color: white; }
    .list-social .fa-twitter:hover { background: #1da1f2; color: white; }
    .list-social .fa-instagram:hover { background: #e4405f; color: white; }
    .list-social .fa-pinterest:hover { background: #bd081c; color: white; }
</style>

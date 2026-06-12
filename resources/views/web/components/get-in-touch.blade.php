{{-- ===== Get in Touch section ===== --}}
<section class="parallax-container call_section contact-subscribe">
    <div class="parallax-content section-md context-dark">
        <div class="container">
            <div class="row justify-content-between align-items-center contact-subscribe__row">

                <div class="col-12 col-md-7 col-lg-6 contact-subscribe__title-col">
                    <h2 class="parallax-title contact-subscribe__title wow fadeInLeft" data-wow-delay=".1s">
                        <span class="contact-subscribe__title-line">@lang('messages.get_in_touch_line1')</span>
                        <span class="contact-subscribe__title-line contact-subscribe__title-line--accent">@lang('messages.get_in_touch_line2')</span>
                    </h2>
                </div>

                <div class="col-12 col-md-auto contact-subscribe__btn-col wow fadeInRight" data-wow-delay=".15s">
                    <button type="button"
                            id="contactModalTrigger"
                            class="button button-zakaria button-primary button-shadow-2 contact-subscribe__open-btn">
                        @lang('messages.send_request')
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===== Contact Modal ===== --}}
<div class="cmodal-overlay" id="contactModal" role="dialog" aria-modal="true" aria-labelledby="cmodalTitle">
    <div class="cmodal" id="cmodalBox">

        {{-- top accent strip --}}
        <div class="cmodal__strip"></div>

        {{-- close --}}
        <button class="cmodal__close" id="contactModalClose" type="button" aria-label="@lang('messages.close')">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M11 1L1 11M1 1L11 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        </button>

        {{-- header --}}
        <div class="cmodal__head">
            <div class="cmodal__logo-wrap">
                <img class="cmodal__logo" src="{{ asset('img/web/tab-photo.png') }}" alt="Emmy">
            </div>
            <h3 class="cmodal__title" id="cmodalTitle">
                @lang('messages.get_in_touch_line1')
                <span class="cmodal__title-accent">@lang('messages.get_in_touch_line2')</span>
            </h3>
            <p class="cmodal__sub">@lang('messages.contact_availability')</p>
        </div>

        {{-- form --}}
        <form class="cmodal__form ch-form ch-mailform"
              data-form-output="form-output-global"
              data-form-type="subscribe"
              method="post"
              action="{{ route('contact.submit') }}">
            @csrf

            <div class="cmodal__field" id="cfield-name">
                <label class="cmodal__label" for="cmod-name">@lang('messages.your_name')</label>
                <input class="cmodal__input" id="cmod-name" type="text" name="first_name"
                       autocomplete="given-name" placeholder=" " required/>
            </div>

            <div class="cmodal__field" id="cfield-email">
                <label class="cmodal__label" for="cmod-email">@lang('messages.your_email_address')</label>
                <input class="cmodal__input" id="cmod-email" type="email" name="email"
                       autocomplete="email" placeholder=" " required/>
            </div>

            <button type="submit" class="cmodal__submit">
                @lang('messages.send_request')
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>

    </div>
</div>

{{-- ===== Styles ===== --}}
<style>
/* ── section ──────────────────────────────────────── */
.contact-subscribe__row        { row-gap: 24px; }
.contact-subscribe__title      { margin-bottom: 0; color: #fff; font-size: 26px; line-height: 1.3; text-align: center; }
.contact-subscribe__title-line { display: block; }
.contact-subscribe__title-line--accent { color: #50BECF; }
.contact-subscribe__btn-col    { text-align: center; }
.contact-subscribe__open-btn   { white-space: nowrap; min-width: 200px; padding: 16px 36px; letter-spacing: .08em; text-transform: uppercase; font-size: 13px; font-family: 'Poppins', sans-serif; }

@media(min-width:576px)  { .contact-subscribe__title { font-size: 32px; } }
@media(min-width:768px)  { .contact-subscribe__title { font-size: 38px; } .contact-subscribe__btn-col { text-align: right; } }
@media(min-width:992px)  { .contact-subscribe__title { font-size: 42px; text-align: left; } }
@media(min-width:1200px) { .contact-subscribe__title { font-size: 48px; line-height: 1.15; } }

/* ── overlay ──────────────────────────────────────── */
.cmodal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 10000;
    background: rgba(22, 32, 42, 0.62);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.cmodal-overlay.is-open { display: flex; }

/* ── modal card (matches auth-card) ──────────────── */
.cmodal {
    position: relative;
    width: 100%;
    max-width: 460px;
    background: #ffffff;
    border-radius: 22px;
    border: 1px solid rgba(80, 190, 207, 0.22);
    box-shadow: 0 16px 48px rgba(27, 39, 51, 0.18), 0 2px 8px rgba(80,190,207,0.08);
    overflow: hidden;
    animation: cmodIn .28s cubic-bezier(.34,1.18,.64,1) both;
    font-family: 'Poppins', sans-serif;
}
@keyframes cmodIn {
    from { opacity: 0; transform: scale(.90) translateY(20px); }
    to   { opacity: 1; transform: scale(1)   translateY(0);    }
}

/* ── teal accent strip at top ─────────────────────── */
.cmodal__strip {
    height: 5px;
    background: linear-gradient(90deg, #50BECF 0%, #3aa9bb 60%, #a8e6ee 100%);
}

/* ── close button ─────────────────────────────────── */
.cmodal__close {
    position: absolute;
    top: 14px; right: 16px;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    border: none;
    background: rgba(44, 52, 59, 0.08);
    color: #6e7781;
    border-radius: 50%;
    cursor: pointer;
    transition: background .2s, color .2s, transform .25s;
    z-index: 2;
}
.cmodal__close:hover {
    background: rgba(80, 190, 207, 0.15);
    color: #50BECF;
    transform: rotate(90deg);
}

/* ── header ───────────────────────────────────────── */
.cmodal__head {
    text-align: center;
    padding: 28px 32px 16px;
}

.cmodal__logo-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 56px; height: 56px;
    border-radius: 14px;
    border: 1px solid rgba(80,190,207,0.25);
    background: rgba(80,190,207,0.07);
    margin-bottom: 14px;
    overflow: hidden;
}
.cmodal__logo {
    width: 38px; height: 38px;
    object-fit: contain;
}

.cmodal__title {
    margin: 0 0 8px;
    font-size: 22px;
    font-weight: 700;
    color: #2f3740;
    line-height: 1.25;
}
.cmodal__title-accent { color: #50BECF; }

.cmodal__sub {
    margin: 0;
    font-size: 13px;
    color: #6e7781;
    line-height: 1.6;
    max-width: 320px;
    margin-inline: auto;
}

/* ── divider ──────────────────────────────────────── */
.cmodal__head + .cmodal__form {
    border-top: 1px solid #eef0f2;
}

/* ── form ─────────────────────────────────────────── */
.cmodal__form {
    padding: 24px 32px 32px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* ── field ────────────────────────────────────────── */
.cmodal__field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cmodal__label {
    font-size: 13px;
    font-weight: 600;
    color: #46515d;
    letter-spacing: .02em;
}

.cmodal__input {
    width: 100%;
    height: 46px;
    padding: 0 14px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    color: #2f3740;
    background: #ffffff;
    border: 1px solid #d7dee5;
    border-radius: 12px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease;
    -webkit-appearance: none;
}
.cmodal__input::placeholder { color: #b0b8c1; }
.cmodal__input:focus {
    border-color: #50BECF;
    box-shadow: 0 0 0 3px rgba(80, 190, 207, 0.20);
}

/* error state */
.cmodal__field.has-error .cmodal__input {
    border-color: #f5543f;
    box-shadow: 0 0 0 3px rgba(245,84,63,0.15);
}
.cmodal__field.has-error .cmodal__label { color: #f5543f; }

/* ── submit button (matches auth-submit) ──────────── */
.cmodal__submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    height: 46px;
    margin-top: 4px;
    border: none;
    border-radius: 12px;
    background: #50BECF;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
}
.cmodal__submit svg { flex-shrink: 0; transition: transform .2s; }
.cmodal__submit:hover {
    background: #626469;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(80, 190, 207, 0.32);
}
.cmodal__submit:hover svg { transform: translateX(3px); }
.cmodal__submit:active { transform: translateY(0); box-shadow: none; }

/* ── mobile ───────────────────────────────────────── */
@media(max-width:575.98px) {
    .cmodal { border-radius: 18px; }
    .cmodal__head { padding: 24px 20px 14px; }
    .cmodal__form { padding: 20px 20px 26px; gap: 16px; }
    .cmodal__title { font-size: 19px; }
    .contact-subscribe__open-btn { width: 100%; }
}
</style>

{{-- ===== Script ===== --}}
<script>
(function () {
    var overlay  = document.getElementById('contactModal');
    var trigger  = document.getElementById('contactModalTrigger');
    var closeBtn = document.getElementById('contactModalClose');
    var box      = document.getElementById('cmodalBox');

    if (!overlay || !trigger) return;

    function openModal() {
        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
            var first = overlay.querySelector('.cmodal__input');
            if (first) first.focus();
        }, 120);
    }

    function closeModal() {
        overlay.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    trigger.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    overlay.addEventListener('click', function (e) {
        if (!box.contains(e.target)) closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeModal();
    });

    /* validation highlight */
    overlay.querySelectorAll('.cmodal__field').forEach(function (field) {
        var input = field.querySelector('.cmodal__input');
        if (!input) return;
        input.addEventListener('invalid', function () { field.classList.add('has-error'); });
        input.addEventListener('input',   function () { field.classList.remove('has-error'); });
    });
})();
</script>

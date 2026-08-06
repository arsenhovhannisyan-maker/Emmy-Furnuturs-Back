<x-web-layout>
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.order_confirmed')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ route('web.home') }}">@lang('messages.home')</a></li>
                        <li class="active">@lang('messages.order_confirmed')</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section section-md bg-default">
            <div class="container">
                <div class="order-success-banner">
                    <span class="mdi mdi-check-circle-outline order-success-icon" aria-hidden="true"></span>
                    <div>
                        <h3 class="font-weight-medium mb-1">@lang('messages.order_thank_you')</h3>
                        <p class="mb-0">@lang('messages.order_number_label'): <strong>{{ $order->order_number }}</strong></p>
                    </div>
                </div>

                <div class="row row-30 mt-4">
                    <div class="col-lg-7">
                        <div class="table-custom-responsive">
                            <table class="table-custom table-cart">
                                <thead>
                                <tr>
                                    <th>@lang('messages.product_name')</th>
                                    <th>@lang('messages.price')</th>
                                    <th>@lang('messages.quantity')</th>
                                    <th>@lang('messages.total')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            {{ $item->product->name ?? __('messages.product_name') }}
                                            @if($item->size_label)
                                                <span class="text-muted d-block" style="font-size: 13px;">{{ __('messages.select_size') }}: {{ $item->size_label }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->price, 2) }} @lang('messages.currency_rub')</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total, 2) }} @lang('messages.currency_rub')</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="order-summary mt-3">
                            <div class="summary-item summary-total">
                                <span>@lang('messages.total')</span>
                                <span>{{ number_format($order->total, 2) }} @lang('messages.currency_rub')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="order-info-card">
                            <h4 class="font-weight-medium mb-3">@lang('messages.order_details')</h4>
                            <div class="order-info-row">
                                <span>@lang('messages.order_number_label')</span>
                                <strong>{{ $order->order_number }}</strong>
                            </div>
                            <div class="order-info-row">
                                <span>@lang('messages.order_date')</span>
                                <strong>{{ $order->created_at->format('d.m.Y H:i') }}</strong>
                            </div>
                            <div class="order-info-row">
                                <span>@lang('messages.order_status')</span>
                                <strong>{{ $order->status->labelRu() }}</strong>
                            </div>
                            <div class="order-info-row">
                                <span>@lang('messages.payment_methods')</span>
                                <strong>@lang('messages.' . $order->payment_method)</strong>
                            </div>
                            <hr class="hr-gray-100">
                            <div class="order-info-row">
                                <span>@lang('messages.delivery_address')</span>
                                <strong>{{ $order->shipping_full_address }}</strong>
                            </div>
                            <div class="order-info-row">
                                <span>@lang('messages.phone')</span>
                                <strong>{{ $order->shipping_phone }}</strong>
                            </div>

                            <a href="{{ route('order.pdf', $order->id) }}" target="_blank" class="button button-lg button-primary button-zakaria mt-4 d-block text-center">
                                <span class="mdi mdi-file-pdf-box" aria-hidden="true"></span>
                                @lang('messages.download_pdf')
                            </a>
                            <a href="{{ route('web.products') }}" class="button button-lg button-default-outline-2 button-zakaria mt-3 d-block text-center">
                                @lang('messages.continue_shopping')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('web.components.our-brand')
    </div>

    <style>
        .order-success-banner {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            padding: 20px 24px;
        }

        .order-success-icon {
            font-size: 48px;
            color: #10b981;
            flex-shrink: 0;
        }

        .order-info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 24px;
        }

        .order-info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .order-info-row:last-of-type {
            border-bottom: none;
        }

        @media (max-width: 575px) {
            .order-success-banner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</x-web-layout>

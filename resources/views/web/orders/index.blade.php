<x-web-layout>
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.my_orders')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ route('web.home') }}">@lang('messages.home')</a></li>
                        <li class="active">@lang('messages.my_orders')</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section section-md bg-default">
            <div class="container">
                <div class="table-custom-responsive">
                    <table class="table-custom table-cart">
                        <thead>
                        <tr>
                            <th>@lang('messages.order_number_label')</th>
                            <th>@lang('messages.order_date')</th>
                            <th>@lang('messages.order_status')</th>
                            <th>@lang('messages.total')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                <td>{{ $order->status->labelRu() }}</td>
                                <td>{{ number_format($order->total, 2) }} @lang('messages.currency_rub')</td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}" class="button button-sm button-primary button-zakaria">
                                        @lang('messages.view_details')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <p class="text-muted">@lang('messages.no_orders_found')</p>
                                    <a href="{{ route('web.products') }}" class="button button-primary button-zakaria">
                                        @lang('messages.continue_shopping')
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @include('web.components.our-brand')
    </div>
</x-web-layout>

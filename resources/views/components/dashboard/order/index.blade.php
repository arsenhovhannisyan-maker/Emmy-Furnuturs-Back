<x-dashboard.layouts.app>
    <div class="container-fluid">
        <div class="card mb-4">
            <x-dashboard.layouts.partials.card-header :createRoute="route('dashboard.orders.create')"/>

            <div class="card-body">
                <x-dashboard.datatable._filters_form>
                    <div class="col-md-4 form-group">
                        <x-dashboard.form._input name="id" type="number"/>
                    </div>

                    <div class="col-md-4 form-group">
                        <x-dashboard.form._input name="status"/>
                    </div>

                    <div class="col-md-4 form-group">
                        <x-dashboard.form._input name="order_number"/>
                    </div>

                    <div class="col-md-4 form-group">
                        <x-dashboard.form._input name="shipping_email" title="email"/>
                    </div>

                    <div class="col-md-4 form-group">
                        <x-dashboard.form._input name="shipping_phone" title="phone"/>
                    </div>
                </x-dashboard.datatable._filters_form>

                <x-dashboard.datatable._table>
                    <th data-key="id">{{ __('label.id') }}</th>
                    <th data-key="order_number">{{ __('label.order_number') }}</th>
                    <th data-key="status">{{ __('label.status') }}</th>
{{--                    <th data-key="shipping_full_name">{{ __('label.customer') }}</th>--}}
                    <th data-key="shipping_email">{{ __('label.email') }}</th>
                    <th data-key="shipping_phone">{{ __('label.phone') }}</th>
                    <th class="text-center" data-key="total">{{ __('label.total') }}</th>
                    <th data-key="created_at">{{ __('label.created_at') }}</th>
                    <th class="text-center">{{ __('label.actions') }}</th>
                </x-dashboard.datatable._table>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('/js/dashboard/order/index.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.app>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Заказ №{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            line-height: 1.6;
            color: #1f2937;
            padding: 0;
            margin: 0;
        }

        .invoice-container {
            width: 100%;
        }

        .brand-header {
            background-color: #8B4513;
            color: white;
            padding: 22px 30px;
            text-align: center;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 6px 0;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            font-size: 14px;
            margin: 0;
        }

        .invoice-header-table {
            width: 100%;
            background-color: #4f46e5;
            color: white;
        }

        .invoice-header-table td {
            padding: 18px 30px;
            vertical-align: middle;
        }

        .invoice-header-table h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .invoice-header-table p {
            margin: 4px 0 0;
            font-size: 13px;
        }

        .invoice-badge {
            text-align: right;
            font-weight: 700;
            font-size: 14px;
        }

        .invoice-body {
            padding: 20px 30px;
        }

        .section {
            margin-bottom: 22px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-card {
            background-color: #f8fafc;
            border-left: 3px solid #4f46e5;
            padding: 4px 16px;
            margin-bottom: 10px;
        }

        .info-card table {
            width: 100%;
        }

        .info-card td {
            padding: 4px 0;
            vertical-align: top;
        }

        .info-label {
            font-weight: 700;
            white-space: nowrap;
            padding-right: 12px;
            color: #6b7280;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
        }

        .items-table th {
            background-color: #eef2ff;
            color: #4f46e5;
            text-align: left;
            padding: 8px 10px;
            font-weight: 700;
        }

        .items-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table .text-right {
            text-align: right;
        }

        .payment-summary {
            background-color: #eef2ff;
            padding: 4px 18px;
            margin-top: 12px;
        }

        .payment-summary table {
            width: 100%;
        }

        .payment-summary td {
            padding: 5px 0;
        }

        .payment-summary .total-row td {
            font-weight: 700;
            font-size: 16px;
            color: #4f46e5;
            border-top: 2px solid #4f46e5;
            padding-top: 8px;
        }

        .notes-box {
            background-color: #fff9ed;
            border-left: 3px solid #f59e0b;
            padding: 14px 16px;
        }

        .invoice-footer {
            background-color: #f8fafc;
            padding: 14px 30px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="brand-header">
        <div class="brand-title">EMMY FURNITURE</div>
        <div class="brand-subtitle">Мебель для ванной комнаты премиального качества</div>
    </div>

    <table class="invoice-header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Подтверждение заказа</h1>
                <p>Благодарим вас за покупку</p>
            </td>
            <td class="invoice-badge">№{{ $order->order_number }}</td>
        </tr>
    </table>

    <div class="invoice-body">
        <div class="section">
            <div class="info-card">
                <table cellpadding="0" cellspacing="0">
                    <tr><td class="info-label">Дата заказа:</td><td>{{ $order->created_at->format('d.m.Y H:i') }}</td></tr>
                    <tr><td class="info-label">Статус:</td><td>{{ $order->status->labelRu() }}</td></tr>
                    <tr><td class="info-label">Способ оплаты:</td><td>{{ __('messages.' . $order->payment_method) }}</td></tr>
                </table>
            </div>

            <div class="info-card">
                <table cellpadding="0" cellspacing="0">
                    <tr><td class="info-label">Покупатель:</td><td>{{ $order->shipping_full_name }}</td></tr>
                    <tr><td class="info-label">Телефон:</td><td>{{ $order->shipping_phone }}</td></tr>
                    <tr><td class="info-label">Email:</td><td>{{ $order->shipping_email }}</td></tr>
                    <tr><td class="info-label">Адрес:</td><td>{{ $order->shipping_full_address }}</td></tr>
                </table>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Товары</h2>
            <table class="items-table">
                <thead>
                <tr>
                    <th>Товар</th>
                    <th>Размер</th>
                    <th class="text-right">Кол-во</th>
                    <th class="text-right">Цена за ед.</th>
                    <th class="text-right">Итог</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? '—' }}</td>
                        <td>{{ $item->size_label ?? '—' }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->price, 2) }} руб.</td>
                        <td class="text-right">{{ number_format($item->total, 2) }} руб.</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="payment-summary">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>Подытог</td>
                        <td class="text-right">{{ number_format($order->subtotal, 2) }} руб.</td>
                    </tr>
                    @if($order->shipping_cost > 0)
                        <tr>
                            <td>Доставка</td>
                            <td class="text-right">{{ number_format($order->shipping_cost, 2) }} руб.</td>
                        </tr>
                    @endif
                    <tr class="total-row">
                        <td>ИТОГО</td>
                        <td class="text-right">{{ number_format($order->total, 2) }} руб.</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($order->notes)
            <div class="section">
                <div class="notes-box">
                    <strong>Комментарий к заказу:</strong>
                    <div>{{ $order->notes }}</div>
                </div>
            </div>
        @endif
    </div>

    <div class="invoice-footer">
        <p>Спасибо, что выбрали Emmy Furniture! Если у вас есть вопросы по заказу, свяжитесь с нашей службой поддержки.</p>
        <p>mebelemmy@mail.ru &nbsp;•&nbsp; +7 (926) 820-65-74</p>
    </div>
</div>
</body>
</html>

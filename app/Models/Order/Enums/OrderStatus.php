<?php

namespace App\Models\Order\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Paid => 'Paid',
            self::Shipped => 'Shipped',
            self::Delivered => 'Delivered',
            self::Cancelled => 'Cancelled',
            self::Refunded => 'Refunded',
        };
    }

    public function labelRu(): string
    {
        return match ($this) {
            self::Pending => 'В обработке',
            self::Paid => 'Оплачен',
            self::Shipped => 'Отправлен',
            self::Delivered => 'Доставлен',
            self::Cancelled => 'Отменён',
            self::Refunded => 'Возвращён',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

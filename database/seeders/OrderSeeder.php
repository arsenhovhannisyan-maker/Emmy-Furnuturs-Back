<?php

namespace Database\Seeders;

use App\Models\Order\Enums\OrderStatus;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получим пользователей
        $users = User::take(5)->get();

        if ($users->isEmpty()) {
            $this->command->error('No users found! Please run UserSeeder first.');
            return;
        }

        $orders = [];

        for ($i = 1; $i <= 20; $i++) {
            $user = $users->random();
            $status = $this->getRandomStatus();

            $subtotal = mt_rand(5000, 50000) / 100;
            $tax = $subtotal * 0.1;
            $shippingCost = mt_rand(500, 2000) / 100;
            $total = $subtotal + $tax + $shippingCost;

            $orders[] = [
                'user_id' => $user->id,
                'status' => $status,
                'total' => round($total, 2),
                'subtotal' => round($subtotal, 2),
                'tax' => round($tax, 2),
                'order_number' => strtoupper(Str::random(10)),
                'shipping_cost' => round($shippingCost, 2),
                'shipping_first_name' => $this->getRandomFirstName(),
                'shipping_last_name' => $this->getRandomLastName(),
                'shipping_company' => mt_rand(0, 1) ? $this->getRandomCompany() : null,
                'shipping_email' => $this->getRandomEmail(),
                'shipping_phone' => $this->getRandomPhone(),
                'shipping_address' => $this->getRandomAddress(),
                'shipping_city' => $this->getRandomCity(),
                'shipping_state' => $this->getRandomState(),
                'shipping_country' => 'United States',
                'shipping_zip_code' => $this->getRandomZipCode(),
                'notes' => mt_rand(0, 1) ? $this->getRandomNotes() : null,
                'created_at' => now()->subDays(mt_rand(0, 30)),
                'updated_at' => now(),
            ];
        }

        // Вставляем данные по одному чтобы избежать ошибок
        foreach ($orders as $order) {
            try {
                DB::table('orders')->insert($order);
            } catch (\Exception $e) {
                $this->command->error("Error inserting order: " . $e->getMessage());
                continue;
            }
        }

        $this->command->info('20 orders seeded successfully!');
    }

    private function getRandomStatus(): string
    {
        $statuses = [
            OrderStatus::Pending->value,
            OrderStatus::Paid->value,
            OrderStatus::Shipped->value,
            OrderStatus::Delivered->value,
            OrderStatus::Cancelled->value,
            OrderStatus::Refunded->value,
        ];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomFirstName(): string
    {
        $firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Lisa', 'Robert', 'Emily', 'William', 'Jessica'];
        return $firstNames[array_rand($firstNames)];
    }

    private function getRandomLastName(): string
    {
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez'];
        return $lastNames[array_rand($lastNames)];
    }

    private function getRandomCompany(): string
    {
        $companies = ['Tech Solutions Inc.', 'Global Enterprises', 'Innovative Systems', 'Digital Dynamics', 'Creative Works LLC'];
        return $companies[array_rand($companies)];
    }

    private function getRandomEmail(): string
    {
        $domains = ['gmail.com', 'yahoo.com', 'hotmail.com'];
        $name = strtolower($this->getRandomFirstName() . $this->getRandomLastName());
        return $name . mt_rand(1, 99) . '@' . $domains[array_rand($domains)];
    }

    private function getRandomPhone(): string
    {
        return '+1-' . mt_rand(200, 999) . '-' . mt_rand(200, 999) . '-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function getRandomAddress(): string
    {
        $streets = ['Main St', 'Oak Ave', 'Maple Dr', 'Elm St', 'Pine Rd'];
        $numbers = mt_rand(100, 9999);
        return $numbers . ' ' . $streets[array_rand($streets)];
    }

    private function getRandomCity(): string
    {
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia'];
        return $cities[array_rand($cities)];
    }

    private function getRandomState(): string
    {
        $states = ['CA', 'NY', 'TX', 'FL', 'IL', 'PA', 'OH', 'GA', 'NC', 'MI'];
        return $states[array_rand($states)];
    }

    private function getRandomZipCode(): string
    {
        return str_pad(mt_rand(10000, 99999), 5, '0', STR_PAD_LEFT);
    }

    private function getRandomNotes(): string
    {
        $notes = [
            'Please leave package at front door.',
            'Signature required for delivery.',
            'Call before delivery.',
            'Leave with neighbor if not home.',
            'Fragile items, handle with care.'
        ];
        return $notes[array_rand($notes)];
    }
}

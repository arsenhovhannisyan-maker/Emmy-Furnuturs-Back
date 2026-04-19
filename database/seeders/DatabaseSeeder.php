<?php

namespace Database\Seeders;

use App\Models\User\User;
use Database\Seeders\DemoCatalogSeeder;
use Database\Seeders\EmmyPhoto\CategorySeeder;
use Database\Seeders\EmmyPhoto\ProductSeeder;
use Database\Seeders\Menu\MenuSeeder;
use Database\Seeders\RoleAndPermission\RoleAndPermissionSeeder;
use Database\Seeders\User\AdminUserSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $hasEmmyPhotoSource = CategorySeeder::resolveBasePath() !== null;

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('orders')->truncate();

        if ($hasEmmyPhotoSource) {
            DB::table('product_sizes')->truncate();
            DB::table('products')->truncate();
            DB::table('categories')->truncate();
        }

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $seeders = [
            RoleAndPermissionSeeder::class,
            AdminUserSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            OrderSeeder::class,
        ];

        if ($hasEmmyPhotoSource) {
            $seeders[] = CategorySeeder::class;
            $seeders[] = ProductSeeder::class;
        } else {
            $this->command?->line('Источник Emmy Photo не найден — демо-каталог без фотографий (DemoCatalogSeeder).');
            $seeders[] = DemoCatalogSeeder::class;
        }

        $this->call($seeders);
    }
}

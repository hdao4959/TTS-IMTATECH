<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => "Thành viên đăng ký",
                'slug' => 'thanh-vien-dang-ky',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Cộng tác viên",
                'slug' => 'cong-tac-vien',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Tác giả",
                'slug' => 'tac-gia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Biên tập viên",
                'slug' => 'bien-tap-vien',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Quản lý",
                'slug' => 'quan-ly',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

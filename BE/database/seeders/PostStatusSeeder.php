<?php

namespace Database\Seeders;

use App\Models\Post_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post_status::insert([
            [
                'name' => 'Bản nháp',
                'slug' => 'ban-nhap',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chờ duyệt',
                'slug' => 'cho-duyet',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Riêng tư',
                'slug' => 'rieng-tu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Đã lên lịch',
                'slug' => 'da-len-lich',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Đã đăng",
                'slug' => 'da-dang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

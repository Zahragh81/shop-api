<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        /**
         * categories permissions
         */

        Permission::query()->insert([
            [
                'title' => 'create-category',
                'label' => 'ایجاد دسته بندی'
            ],
            [
                'title' => 'read-category',
                'label' => 'مشاهده دسته بندی'
            ],
            [
                'title' => 'update-category',
                'label' => 'ویرایش دسته بندی'
            ],
            [
                'title' => 'delete-category',
                'label' => 'حذف دسته بندی'
            ],
        ]);


        /**
         * brands permissions
         */

        Permission::query()->insert([
            [
                'title' => 'create-category',
                'label' => 'ایجاد دسته بندی'
            ],
            [
                'title' => 'read-category',
                'label' => 'مشاهده دسته بندی'
            ],
            [
                'title' => 'update-category',
                'label' => 'ویرایش دسته بندی'
            ],
            [
                'title' => 'delete-category',
                'label' => 'حذف دسته بندی'
            ],
        ]);

    }
}

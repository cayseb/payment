<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminNavigationSeeder extends Seeder
{
    private const NAVIGATION_TABLE = 'admin_menu';
    private const SEED_DATA_FILE = 'database/data/admin-navigation.php';
    private const SEED_DATA = [
//        [
//            "parent_id"=> 0,
//            "order" => 1,
//            "title" => "Панель управления",
//            "icon" => "fa-bar-chart",
//            "uri" => "/",
//            "permission" => null
//        ],
        [
            "parent_id" => 0,
            "order" => 0,
            "title" => "Статьи",
            "icon" => "fa-comments",
            "uri" => "/articles",
            "permission" => null
        ],
        [
            "parent_id" => 0,
            "order" => 1,
            "title" => "Тэги",
            "icon" => "fa-comments",
            "uri" => "/tags",
            "permission" => null
        ],
        [
            "parent_id" => 0,
            "order" => 1,
            "title" => "Трафик",
            "icon" => "fa-comments",
            "uri" => "/traffic",
            "permission" => null
        ],



    ];

    public function run()
    {
        $this->clearTable();
//        $data = include(self::SEED_DATA_FILE);
        $data = self::SEED_DATA;

        foreach ($data as $item) {
            $id = $this->createItem(
                $item['parent_id'],
                $item['order'],
                $item['title'],
                $item['icon'],
                $item['uri'],
                $item['permission']
            );

            if (isset($item['child']) && !empty($item['child'])) {
                foreach ($item['child'] as $child) {
                    $this->createItem(
                        $id,
                        $child['order'],
                        $child['title'],
                        $child['icon'],
                        $child['uri'],
                        $child['permission']
                    );
                }
            }
        }
    }

    private function clearTable(): void
    {
        DB::table(self::NAVIGATION_TABLE)->truncate();
    }

    private function createItem($parentId, $order, $title, $icon, $uri, $permission): int
    {
        return DB::table(self::NAVIGATION_TABLE)->insertGetId([
            'parent_id' => $parentId,
            'order' => $order,
            'title' => $title,
            'icon' => $icon,
            'uri' => $uri,
            'permission' => $permission
        ]);
    }
}

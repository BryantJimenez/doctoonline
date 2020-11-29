<?php

use Illuminate\Database\Seeder;

class CategorynewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_news = [
    		['id' => 1, 'news_id' => 1, 'category_id' => 1],
            ['id' => 2, 'news_id' => 2, 'category_id' => 1],
            ['id' => 3, 'news_id' => 3, 'category_id' => 1],
    	];
    	DB::table('category_news')->insert($category_news);
    }
}

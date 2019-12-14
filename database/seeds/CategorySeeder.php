<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Others',
                'slug' => 'other'
            ],
            [
                'name' => 'Mathematics',
                'slug' => 'math'
            ],
            [
                'name' => 'Information and Communication Technologies',
                'slug' => 'ict'
            ],
            [
                'name' => 'Entertainments',
                'slug' => 'entertainment'
            ],
            [
                'name' => 'Physics',
                'slug' => 'physic'
            ],
            [
                'name' => 'Social Science',
                'slug' => 'social-science'
            ],
            [
                'name' => 'Natural Science',
                'slug' => 'natural-science'
            ],
            [
                'name' => 'Chemistry',
                'slug' => 'chemistry'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

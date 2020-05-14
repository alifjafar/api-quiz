<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke()
    {
        $categories = Category::withCount('quizzes')->get();


        return CategoryResource::collection($categories);
    }
}

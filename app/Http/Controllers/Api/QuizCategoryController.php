<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\QuizCategoryResource;
use App\Http\Resources\QuizResource;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    public function private($category)
    {
        $category = Category::with(['quizzes'])->where('slug', $category)->firstOrFail();
        $quiz = $category->quizzes()->with(['client','category','questions'])->whereClientId(auth()->id())->paginate(20);

        return QuizResource::collection($quiz)->additional([
            'meta' => [
                'category' => CategoryResource::make($category)
            ]
        ]);
    }

    public function public($category)
    {
        $category = Category::with(['quizzes'])->where('slug', $category)->firstOrFail();
        $quiz = $category->quizzes()->with(['client','category','questions'])->whereIsPrivate(false)->paginate(20);

        return QuizResource::collection($quiz)->additional([
            'meta' => [
                'category' => CategoryResource::make($category)
            ]
        ]);
    }
}

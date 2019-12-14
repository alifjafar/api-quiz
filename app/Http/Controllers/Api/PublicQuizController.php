<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class PublicQuizController extends Controller
{
    public function __invoke()
    {
        $quiz = Quiz::with(['questions', 'category', 'client'])->whereIsPrivate(false)->latest()->paginate(20);


        return QuizResource::collection($quiz);
    }
}

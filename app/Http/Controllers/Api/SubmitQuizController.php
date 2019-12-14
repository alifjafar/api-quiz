<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class SubmitQuizController extends Controller
{
    public function __invoke(Request $request, Quiz $quiz)
    {
        $validated = $this->validate($request, [
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.answer' => 'required|exists:options,id'
        ]);

        $quiz->load(['questions.options', 'questions.answer']);

        $passes = 0;

        foreach ($validated['questions'] as $question) {
            $quizQuestion = $quiz->questions->where('id', $question['id'])->first();

            if ($quizQuestion['answer']['option_id'] === $question['answer']) {
                $passes += 1;
            }
        }

        $totalQuiz = $quiz['total_question'];

        $score = round($passes * 100 / $totalQuiz, 1);

        return response()->json([
            'data' => [
                'message' => 'Your Score is ' . $score . ' pts',
                'score' => $score
            ],
            'meta' => [
                'http_status' => 200
            ]
        ], 200);
    }
}

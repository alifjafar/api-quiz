<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubmitQuizRequest;
use App\Models\Quiz;
use App\Resources\BaseResponse;

class SubmitQuizController extends Controller
{
    public function __invoke(SubmitQuizRequest $request, Quiz $quiz)
    {
        $validated = $request->validated();

        $quiz->load(['questions.options', 'questions.answer']);

        $score = $this->calculateScore($quiz, $validated);

        return (new BaseResponse)
                ->setMessage("Success")
                ->setData([
                    'message' => 'Your Score is ' . $score . ' pts',
                    'score' => $score
                ])
                ->build();
    }

    /**
     * @param Quiz $quiz
     * @param $request
     * @return false|float
     */
    private function calculateScore(Quiz $quiz, $request)
    {
        $passes = 0;

        foreach ($request['questions'] as $question) {
            $quizQuestion = $quiz->questions->where('id', $question['id'])->first();

            if ($quizQuestion['answer']['option_id'] === $question['answer']) {
                $passes += 1;
            }
        }

        $totalQuiz = $quiz['total_question'];

        return round($passes * 100 / $totalQuiz, 1);
    }
}

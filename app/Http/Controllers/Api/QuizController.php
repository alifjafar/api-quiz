<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuizRequest;
use App\Http\Requests\Api\ShowQuizRequest;
use App\Http\Resources\QuizResource;
use App\Http\Resources\QuizWithQuestionResource;
use App\Models\QuestionAnswer;
use App\Models\Quiz;
use App\Resources\BaseResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::with(['questions', 'category'])->onlyMine()->latest()->paginate(20);

        return QuizResource::collection($quiz);
    }

    public function show(ShowQuizRequest $request, Quiz $quiz)
    {
        $quiz->load([
            'questions' => function ($query) {
                return $query->inRandomOrder();
            },
            'questions.options' => function ($query) {
                return $query->inRandomOrder();
            },
            'category'
        ]);

        return QuizWithQuestionResource::make($quiz);
    }

    public function edit(Quiz $quiz)
    {
        $this->authorize('edit', $quiz);

        $quiz->load(['questions.options', 'category', 'questions.answer.option']);

        return QuizWithQuestionResource::make($quiz);
    }


    public function store(QuizRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $quiz = Quiz::create($validated + ['client_id' => auth()->id()]);

            foreach ($validated['questions'] as $question) {
                $questionCreated = $quiz->questions()->create($question);
                foreach ($question['options'] as $option) {
                    $optionCreated = $questionCreated->options()->create([
                        'content' => $option['content']
                    ]);

                    if ($option['answer'] ?? null) {
                        QuestionAnswer::create([
                            'question_id' => $questionCreated['id'],
                            'option_id' => $optionCreated['id']
                        ]);
                    }
                }
            }
            DB::commit();
            return (new BaseResponse)
                ->setMessage('Success created quiz')
                ->setData([
                    'quiz_id' => $quiz['id']
                ])
                ->setStatus(201)
                ->build();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $validated = $request->validated();

        $quiz->load(['questions.options', 'questions.answer']);

        $notDeleted = new Collection();
        DB::beginTransaction();

        try {
            $quiz->update($validated);

            foreach ($validated['questions'] as $item) {
                $question = $quiz->questions()->updateOrCreate(['id' => $item['id'] ?? null], $item);
                $quizAnswer = QuestionAnswer::where('question_id', $question['id'])->first();

                foreach ($item['options'] as $option) {
                    $newOption = $question->options()->updateOrCreate(
                        ['id' => $option['id'] ?? null],
                        ['content' => $option['content']]
                    );

                    if ($option['answer'] ?? null) {
                        if ($quizAnswer) {
                            $quizAnswer->update([
                                'question_id' => $question['id'],
                                'option_id' => $newOption['id']
                            ]);
                        } else {
                            QuestionAnswer::create([
                                'question_id' => $question['id'],
                                'option_id' => $newOption['id']
                            ]);
                        }
                    }
                }
                $notDeleted->push($question['id']);
            }

            if ($notDeleted)
                $quiz->questions()->whereNotIn('id', $notDeleted->toArray())->delete();

            DB::commit();
            return (new BaseResponse)
                ->setMessage('Success update quiz')
                ->setData([
                    'quiz_id' => $quiz['id']
                ])
                ->setStatus(200)
                ->build();
        } catch (QueryException $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);

        $quiz->delete();

        return (new BaseResponse)
            ->setMessage('Success Delete Quiz')
            ->setStatus(200)
            ->build();
    }
}

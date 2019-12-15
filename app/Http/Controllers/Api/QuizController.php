<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Http\Resources\QuizWithQuestionResource;
use App\Models\QuestionAnswer;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::with(['questions', 'category'])->onlyMine()->latest()->paginate(20);

        return QuizResource::collection($quiz);
    }

    public function show(Request $request, Quiz $quiz)
    {
        $this->authorize('view', $quiz);

        if ($quiz['is_private']) {
            $validated = $this->validate($request, [
                'password' => 'required'
            ]);

            if ($validated['password'] !== $quiz['password']) {
                return (new ErrorResponse())->errorResponse(
                    'Quiz Password is incorrect',
                    422,
                    null,
                    'password'
                );
            }
        }

        $quiz->load([
            'questions' => function ($q) {
                return $q->inRandomOrder();
            },
            'questions.options' => function ($q) {
                return $q->inRandomOrder();
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


    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_private' => 'required|boolean',
            'password' => 'required_if:is_private,true',
            'questions' => 'required|array',
            'questions.*.content' => 'required|string',
            'questions.*.options.*.content' => 'required|string',
            'questions.*.options.*.answer' => 'sometimes|nullable',
        ]);

        $res = [];

        DB::beginTransaction();

        try {
            $quiz = Quiz::create($validated + ['client_id' => auth()->id()]);

            foreach ($validated['questions'] as $item) {
                $question = $quiz->questions()->create($item);
                foreach ($item['options'] as $op) {
                    $option = $question->options()->create([
                        'content' => $op['content']
                    ]);

                    if ($op['answer'] ?? null) {
                        QuestionAnswer::create([
                            'question_id' => $question['id'],
                            'option_id' => $option['id']
                        ]);
                    }
                }
            }
            DB::commit();
            $res = [
                'message' => [
                    'data' => [
                        'message' => 'Success created quiz',
                        'quiz_id' => $quiz['id']
                    ],
                    'meta' => [
                        'http_status' => 201
                    ]
                ],
                'code' => 201
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            $res = [
                'message' => [
                    'data' => [
                        'message' => 'Failed created quiz',
                    ],
                    'meta' => [
                        'http_status' => 400
                    ]
                ],
                'code' => 400
            ];
        }

        return response()->json($res['message'], $res['code']);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $validated = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_private' => 'required|boolean',
            'password' => 'required_if:is_private,true',
            'questions' => 'required|array',
            'questions.*.content' => 'required|string',
            'questions.*.id' => 'sometimes|nullable',
            'questions.*.options.*.id' => 'sometimes|nullable|exists:options,id',
            'questions.*.options.*.content' => 'required|string',
            'questions.*.options.*.answer' => 'sometimes|nullable',
        ]);


        $quiz->load(['questions.options', 'questions.answer']);

        $res = [];
        $notDeleted = new Collection();
        DB::beginTransaction();

        try {
            $quiz->update($validated);

            foreach ($validated['questions'] as $item) {
                $question = $quiz->questions()->updateOrCreate(['id' => $item['id'] ?? null], $item);
                foreach ($item['options'] as $option) {
                    $option = $question->options()->updateOrCreate(['id' => $option['id'] ?? null],
                        [
                            'content' => $option['content']
                        ]
                    );

                    if ($option['answer'] ?? null) {
                        $question->answer()->updateOrCreate(['question_id' => $question['id'] ?? null], [
                            'question_id' => $question['id'],
                            'option_id' => $option['id']
                        ]);
                    }
                }
                $notDeleted->push($question['id']);
            }

            if ($notDeleted)
                $quiz->questions()->whereNotIn('id', $notDeleted->toArray())->delete();
            DB::commit();
            $res = [
                'message' => [
                    'data' => [
                        'message' => 'Success update quiz',
                        'quiz_id' => $quiz['id']
                    ],
                    'meta' => [
                        'http_status' => 200
                    ]
                ],
                'code' => 200
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            $res = [
                'message' => [
                    'data' => [
                        'message' => 'Failed update quiz',
                    ],
                    'meta' => [
                        'http_status' => 400
                    ]
                ],
                'code' => 400
            ];
        }

        return response()->json($res['message'], $res['code']);
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);

        $quiz->delete();

        return response()->json([
            'message' => 'Success Delete Quiz'
        ]);
    }
}

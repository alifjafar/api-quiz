<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Quiz;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any quizzes.
     *
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function viewAny(Client $client)
    {
        //
    }

    /**
     * Determine whether the user can view the quiz.
     *
     * @param  \App\Models\Client  $client
     * @param  \App\Models\Quiz  $quiz
     * @return mixed
     */
    public function view(Client $client, Quiz $quiz)
    {
        if ($quiz['is_private']) {
            if ($quiz['client_id'] !== $client['id']) {
                return false;
            }
        }

        return true;
    }

    public function edit(Client $client, Quiz $quiz)
    {
        if ($quiz['client_id'] !== $client['id']) {
            return false;
        }

        return true;
    }

    public function submit(Client $client, Quiz $quiz)
    {
        if ($quiz['is_private']) {
            if ($quiz['client_id'] !== $client['id']) {
                return false;
            }
        }

        return true;
    }


    /**
     * Determine whether the user can update the quiz.
     *
     * @param  \App\Models\Client  $client
     * @param  \App\Models\Quiz  $quiz
     * @return mixed
     */
    public function update(Client $client, Quiz $quiz)
    {
        if ($quiz['client_id'] !== $client['id']) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the quiz.
     *
     * @param  \App\Models\Client  $client
     * @param  \App\Models\Quiz  $quiz
     * @return mixed
     */
    public function delete(Client $client, Quiz $quiz)
    {
        if ($quiz['client_id'] !== $client['id']) {
            return false;
        }

        return true;
    }
}

<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Uuid;

    protected $fillable = [
        'content', 'quiz_id'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function question_answer()
    {
        return $this->hasManyThrough(Option::class, 'question_answers','question_id','option_id');
    }

    public function answer()
    {
        return $this->hasOne(QuestionAnswer::class,'question_id');
    }
}

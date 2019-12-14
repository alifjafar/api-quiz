<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use Uuid;

    protected $fillable = [
        'question_id', 'option_id'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}

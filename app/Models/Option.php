<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Uuid;

    protected $fillable = [
        'content','question_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

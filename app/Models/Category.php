<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Uuid;

    protected $fillable = [
        'name', 'slug'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class)->latest();
    }

    public function getTotalQuizAttribute()
    {
        return $this->quizzes()->count();
    }
}

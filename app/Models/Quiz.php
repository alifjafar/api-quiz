<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use Uuid;

    protected $fillable = [
        'name', 'description', 'client_id', 'password', 'category_id', 'is_private'
    ];

    protected $casts = [
        'is_private' => 'boolean'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function scopeOnlyMine($q)
    {
        return $q->where('client_id', auth()->id());
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getTotalQuestionAttribute()
    {
        return $this->questions()->count('id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'subject_id',
        'score',
    ];

    public function student() {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function subject() {
        return $this->hasOne(Subject::class,'id','subject_id');
    }
}

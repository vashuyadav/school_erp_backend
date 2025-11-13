<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_type_id',
        'short_name',
        'subject_name',
        'status',
    ];

    public function subjectType()
    {
        return $this->belongsTo(SubjectType::class);
    }
}

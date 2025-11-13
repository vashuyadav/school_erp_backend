<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'class_id',
        'section_id',
        'status',
    ];

    // Relationships

    // Session relation
    public function session()
    {
        return $this->belongsTo(ClassSession::class);
    }

    // Class relation
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // Section relation
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Scope for active mappings
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

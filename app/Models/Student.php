<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'phone',
        'address',
        'department',
        'session',
        'membership_date',
        'expiry_date',
        'photo',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'membership_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            if (empty($student->student_id)) {
                $year = now()->year;
                $count = Student::whereYear('created_at', $year)->count() + 1;
                $student->student_id = 'STU-' . $year . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    // public function issues()
    // {
    //     return $this->morphMany(IssueBook::class, 'member');
    // }

    // public function punishments()
    // {
    //     return $this->morphMany(Punishment::class, 'member');
    // }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isMembershipValid()
    {
        return $this->is_active && (!$this->expiry_date || $this->expiry_date->isFuture());
    }

    public function getCurrentIssuesCount()
    {
        return $this->issues()->where('status', 'issued')->count();
    }
}

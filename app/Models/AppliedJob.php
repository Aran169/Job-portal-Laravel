<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_id'];

    /**
     * Get the job that the applied job belongs to.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the user that the applied job belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

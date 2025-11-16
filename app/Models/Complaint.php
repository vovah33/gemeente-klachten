<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'category', 'status', 'lat', 'lng',
        'reporter_name', 'reporter_email', 'user_id', 'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(ComplaintPhoto::class);
    }

    public function notes()
    {
        return $this->hasMany(ComplaintNote::class);
    }
}


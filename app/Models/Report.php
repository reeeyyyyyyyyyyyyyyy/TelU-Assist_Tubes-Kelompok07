<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_category_id',
        'location_id',
        'title',
        'description',
        'photo',
        'status',
        'reported_at',
        'handled_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportCategory()
    {
        return $this->belongsTo(ReportCategory::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

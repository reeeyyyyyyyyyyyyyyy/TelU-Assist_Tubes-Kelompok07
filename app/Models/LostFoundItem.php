<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostFoundItem extends Model
{
    /** @use HasFactory<\Database\Factories\LostFoundItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'item_name',
        'description',
        'category',
        'photo',
        'date',
        'lost_status',
        'found_status',
    ];

    /**
     * Get the user that owns the lost/found item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

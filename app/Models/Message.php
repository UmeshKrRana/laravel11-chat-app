<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
        'file_name',
        'file_name_original',
        'file_path',
        'file_type',
    ];

    protected $appends = ['formatted_date'];

    public function getFormattedDateAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return $date->isToday() ? 'Today' : ($date->isYesterday() ? 'Yesterday' : $date->format('d M Y'));
    }

    // Boot method for model events
    protected static function boot()
    {
        parent::boot();

        // Automatically set created_at during creation
        static::creating(function ($model) {
            $model->created_at = Carbon::now(); // Set the current time
        });
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}

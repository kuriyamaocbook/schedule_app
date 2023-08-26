<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['event_title', 
    'event_body', 
    'start_date',
    'end_date',
    'event_color',
    'event_border_color',
    'user_id'
    ];
    
     // ユーザーとの関連を定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

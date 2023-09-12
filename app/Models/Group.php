<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', /* 他のカラム */];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    // グループとユーザーの多対多の関係を定義
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

}

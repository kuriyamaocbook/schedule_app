<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Schedule;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'family_role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
      public function showUserCalendar($userId)
    {
        $user = User::find($userId);
        $schedules = Schedule::where('user_id', $userId)->get(); // Scheduleモデルからスケジュールを取得

        return view('user_calendar', compact('calendars.calendar', 'schedules'));
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'user_id');
    }
    public static function generateUniqueFamilyId()
    {
        // ユニークな family_id を生成するロジックをここに記述します
        return Str::uuid()->toString(); // 例として UUID を使用
    }
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
    public function groups()
{
    return $this->belongsToMany(Group::class);
} // ユーザーとグループの多対多の関係を定義
}

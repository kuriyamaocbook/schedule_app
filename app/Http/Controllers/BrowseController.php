<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;

class BrowseController extends Controller
{
    public function showSelectedCalendars(Request $request)
    {
        // ユーザー選択フォームから送られてきた選択したユーザーのID配列を取得
        $selectedUserIds = $request->input('selected_users', []);

        // 選択したユーザーの情報を取得
        $selectedUsers = User::whereIn('id', $selectedUserIds)->get();

        // 選択したユーザーのカレンダーデータを取得
        $allUserSchedules = [];

        foreach ($selectedUsers as $user) {
            $userSchedules = Schedule::where('user_id', $user->id)->get();
            $array=$userSchedules->toArray();
            $allUserSchedules = array_merge($allUserSchedules, $array);
        }

        // カレンダー表示ビューにデータを渡して表示
        return view('calendars.calendar', compact('allUserSchedules'));
    }
}

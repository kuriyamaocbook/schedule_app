<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Family;
use Auth; // Authクラスを追加

class ScheduleController extends Controller
{
    public function show()
    {
        return view("calendars/calendar");
    }

    // 新規予定追加
    public function create(Request $request, Schedule $schedule)
    {
        // バリデーション（eventsテーブルの中でNULLを許容していないものをrequired）
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_color' => 'required',
        ]);

        // 登録処理
        //招待した人のユーザーidを表記
        
        $schedule = new Schedule(); // 新しいモデルインスタンスを作成
        $schedule->event_title = $request->input('event_title');
        $schedule->event_body = $request->input('event_body');
        $schedule->start_date = $request->input('start_date');
        $schedule->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day")); // FullCalendarが登録する終了日は仕様で1日ずれるので、その修正を行っている
        $schedule->event_color = $request->input('event_color');
        $schedule->event_border_color = $request->input('event_color');
        $schedule->user_id = \Auth::user()->id;
        
        
        // ここでファミリーの family_id を設定
        //$familyId = Auth::user()->family_id;
        //$schedule->family_id = $familyId;
        
        $schedule->save();

        // カレンダー表示画面にリダイレクトする
        return redirect()->route('show');
    }

    public function get(Request $request, Schedule $schedule)
    {
        // バリデーション
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // 現在カレンダーが表示している日付の期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000); // 日付変換（JSのタイムスタンプはミリ秒なので秒に変換）
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        // 予定取得処理（これがaxiosのresponse.dataに入る）
        return $schedule->query()
            // DBから取得する際にFullCalendarの形式にカラム名を変更する
            ->select(
                'id',
                'event_title as title',
                'event_body as description',
                'start_date as start',
                'end_date as end',
                'event_color as backgroundColor',
                'event_border_color as borderColor'
            )
            // 表示されているカレンダーのeventのみをDBから検索して表示
            //->where('family_id', \Auth::user()->family_id) // ファミリーに関連付けられた予定のみを取得
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date) // AND条件
            ->get();
    }

    public function update(Request $request, Schedule $schedule)
    {
        // 変更箇所
        $input = $request->only(['event_title', 'event_body', 'start_date', 'end_date', 'event_color']);

        // 更新する予定をDBから探し（find）、内容が変更していたらupdated_timeを変更（fill）して、DBに保存する（save）
        $schedule->find($request->input('id'))->fill($input)->save();

        // カレンダー表示画面にリダイレクトする
        return redirect()->route('show');
    }

    // 予定の削除
    public function delete(Request $request, Schedule $schedule)
    {
        // 削除する予定をDBから探し（find）、DBから物理削除する（delete）
        $schedule->find($request->input('id'))->delete();

        // カレンダー表示画面にリダイレクトする
        return redirect()->route('show');
    }

    /**
     * リソースを取得
     */
    public function resourceGet()
    {
        // 変更箇所：Familyモデルを使用
        return Family::query()
            ->select('id', 'building', 'title', 'eventColor') // カラム名を正確に指定
            ->get();
    }

    /**
     * イベントを取得
     */
    public function eventGet()
    {
        // 変更箇所：Scheduleモデルを使用
        return Schedule::query()
            ->select('resourceId', 'title', 'start_time as start', 'end_time as end') // カラム名を正確に指定
            ->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation; // Invitation モデルの名前空間に合わせて修正する


class InvitationController extends Controller
{
    
    public function index()
    {
        // 招待一覧をデータベースから取得
        $invitations = Invitation::all(); // あるいは必要に応じて適切なクエリを実行

        // 取得した招待一覧をビューに渡して表示
        return view('invitations.index', compact('invitations'));
    }

    
public function create()
{
    // グループ作成フォームを表示
    return view('groups.create');
}
public function store(Request $request)
{
    // フォームデータのバリデーションを実行
    // グループを作成
    $group = Group::create([
        'name' => $request->input('name'),
        // 他の必要なカラムを追加
    ]);
    // ユーザーをグループに追加
    auth()->user()->groups()->attach($group);
    // グループ作成成功のメッセージを表示
    return redirect('/groups')->with('success', 'グループが作成されました');

// app/Http/Controllers/InvitationController.php
// フォームデータのバリデーションを実行

    // 招待情報を作成
    $invitation = Invitation::create([
        'inviter_user_id' => auth()->user()->id, // 招待するユーザーのID
        'invitee_user_id' => $request->input('invitee_user_id'), // 招待を受けるユーザーのID
        // 他の必要なカラムを追加
    ]);

    // 招待成功のメッセージを表示
    return redirect('/groups')->with('success', 'ユーザーが招待されました');
}
// app/Http/Controllers/InvitationController.php

public function acceptInvitation(Invitation $invitation)
{
    // ユーザーをグループに追加
    auth()->user()->groups()->attach($invitation->group_id);
    // 招待を削除
    $invitation->delete();
    // 参加成功のメッセージを表示
    return redirect('/groups')->with('success', 'グループに参加しました');
}

}
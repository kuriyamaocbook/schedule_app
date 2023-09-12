<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group; // Groupモデルのインポート
use App\Models\Invitation;
use App\Mail\InvitationMail; // InvitationMail Mailableをインポート
use Illuminate\Support\Facades\Mail; // メール送信のためにMailファサードをインポート


class GroupController extends Controller
{
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
        
            //dd($group);
        // 招待情報を作成
    $invitation = Invitation::create([
        'group_id' => $group->id,
        'user_email' => $request->input('invitee_email'), // 招待対象のユーザーのメールアドレス
        // 他の必要なカラムを追加
    ]);

    // 招待メールを送信
    \Mail::to($invitation->user_email)->send(new InvitationMail($invitation));

    // グループ作成成功のメッセージを表示
    return redirect('/groups')->with('success', 'グループが作成され、ユーザーに招待メールが送信されました');
    
    if (!auth()->check()) {
    // ユーザーが認証されていない場合の処理
    // 例: ログインページにリダイレクトするなど
    return redirect('/login');
}

    }
public function show(Group $group)
{
    return view('groups.show', compact('group'));
}
public function index()
{
    $groups = Group::all(); // または必要なクエリを実行してデータを取得
    return view('groups.index', compact('groups'));
}

public function inviteForm(Group $group)
{
    return view('groups.invite', compact('group'));
}

public function invite(Request $request, Group $group)
{
   // コントローラー内でバリデーションルールを定義
$validationRules = [
    'user_email' => 'required|email', // 例: メールアドレスのバリデーション
];

// バリデーションを実行
$request->validate($validationRules);

    // Invitation モデルを使用して招待を作成および保存
    $invitation = Invitation::create([
        'group_id' => $group->id,
        'user_email' => $request->input('user_email'), // フォームから送信されたメールアドレス
        // 他の必要なカラムを追加
    ]);

    // 招待成功のメッセージを表示
    return redirect()->route('groups.show', $group)->with('success', 'ユーザーが招待されました');
}



}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- 他の head タグやスタイルシートリンクなどを追加 -->
</head>
<body>
    <h1>招待一覧</h1>
    <ul>
        @foreach($invitations as $invitation)
                {{ $invitation->recipient->name }} ({{ $invitation->status }})
                <form action="{{ route('invitations.accept', $invitation) }}" method="POST">
                    @csrf
                    <button type="submit">受け入れる</button>
                </form>
                <form action="{{ route('invitations.destroy', $invitation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
        @endforeach
    </ul>
    <form action="{{ route('invitations.store') }}" method="POST">
                        @csrf
                        <label for="user_e_maile">メールアドレスを記入</label>
                        <input type="text" name="user_e_maile" id="user_e_maile">
                        <button type="submit">招待する</button>
                        </form>
</body>
</html>

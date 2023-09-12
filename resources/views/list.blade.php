@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザー一覧</h1>
    <a href="https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/home" class="button">ホームに戻る</a>
     <a href="https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/invitations" class="button">招待する</a>
     <button onclick="window.location.href='https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/groups'">URLに移動</button>
    <!-- 他のコンテンツ -->
    <!-- 選択したユーザーのカレンダー表示フォーム -->
    <form action="{{ route('calendars.showSelected') }}" method="POST">
        @csrf
        <table class="table">
            <!-- ユーザーリストを表示 -->
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->family_role}}</td>
                </tr>
            @endforeach
        </table>
    </form>
</div>
@endsection

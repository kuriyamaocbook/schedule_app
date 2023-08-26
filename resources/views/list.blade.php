@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザー一覧</h1>
    <a href="https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/home" class="button">ホームに戻る</a>

    <!-- 選択したユーザーのカレンダー表示フォーム -->
    <form action="{{ route('calendars.showSelected') }}" method="POST">
        @csrf
        <table class="table">
            <!-- ユーザーリストを表示 -->
            @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="selected_users[]" value="{{ $user->id }}"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->family_role}}</td>
                </tr>
            @endforeach
        </table>
        <button type="submit" class="btn btn-primary">選択したユーザーのカレンダーを表示</button>
    </form>

    <!-- 他のコンテンツ -->
</div>
@endsection

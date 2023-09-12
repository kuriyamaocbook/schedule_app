@extends('layouts.app')

@section('content')
    <h1>グループ一覧</h1>
    <a href="/groups/create" class="btn btn-primary">グループ作成ページへ</a>
    <ul>
        @foreach ($groups as $group)
            <li>
                <a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection

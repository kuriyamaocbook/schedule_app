<!-- グループの詳細情報を表示するビューを作成 -->
<h1>{{ $group->name }}</h1>
<p>メンバー:</p>
<ul>
    @foreach($group->members as $member)
        <li>{{ $member->name }}</li>
    @endforeach
</ul>
<!-- 他の詳細情報を表示 -->
<!-- グループの詳細情報を表示するビューを作成 -->
<h1>{{ $group->name }}</h1>
<p>メンバー:</p>
<ul>
   <!-- メンバーが存在するかどうかを確認してからループする -->
    @if ($group->members)
        @foreach($group->members as $member)
            <li>{{ $member->name }}</li>
        @endforeach
    @else
        <li>メンバーは存在しません</li>
    @endif

</ul>
<!-- 他の詳細情報を表示 -->

<!-- 招待ボタンを追加 -->
<a href="{{ route('groups.invite.form', $group) }}" class="btn btn-primary">招待する</a>

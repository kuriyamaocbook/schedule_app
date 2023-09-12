@extends('layouts.app') <!-- おそらくデフォルトのレイアウトを継承 -->

@section('content') <!-- レイアウトのコンテンツセクションを開始 -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">グループへの招待</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('groups.invite.submit', $group) }}">
                        @csrf <!-- CSRFトークンを生成 -->

                        <div class="form-group">
                            <label for="user_email">招待対象のメールアドレス</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" required>
                        </div>

                        <!-- 他のフォームフィールドを追加できます -->

                        <button type="submit" class="btn btn-primary">招待する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection <!-- コンテンツセクションを終了 -->

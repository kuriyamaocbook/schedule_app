@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                     <a href="https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/calendar" class="button">カレンダー登録</a>
                      <a href="https://6ef1a6ae45f94c37b1e77b5847ada760.vfs.cloud9.us-east-1.amazonaws.com/list" class="button">リストへ</a>
                     <p>Your family role: {{ Auth::user()->family_role }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

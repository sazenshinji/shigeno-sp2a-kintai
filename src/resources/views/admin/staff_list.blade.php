@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/staff_list.css') }}">
@endsection

@section('content')

<div class="attendance-list-wrapper">

    <h1 class="page-title">スタッフ一覧</h1>

    <table class="attendance-table">

        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>月次勤怠</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>
                    <button class="detail-btn" disabled>
                        詳細
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align:center;">
                    スタッフが登録されていません
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
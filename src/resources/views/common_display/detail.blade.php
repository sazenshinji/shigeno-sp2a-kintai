@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="attendance-list-wrapper">

    <h1 class="page-title">勤怠詳細</h1>

    <table class="attendance-table">
        <tbody>

            {{-- 名前 --}}
            <tr>
                <th>名前</th>
                <td>{{ $user->name }}</td>
            </tr>

            {{-- 日付 --}}
            <tr>
                <th>日付</th>
                <td>
                    <span class="date-year">{{ $date->format('Y年') }}</span>
                    <span class="date-month">{{ $date->format('n月') }}</span>
                    <span class="date-day">{{ $date->format('j日') }}</span>
                </td>
            </tr>

            {{-- 出勤・退勤 --}}
            <tr>
                <th>出勤・退勤</th>
                <td>
                    {{ optional($attendance?->clock_in)->format('H:i') ?? '' }}
                    <span class="time-separator">～</span>
                    {{ optional($attendance?->clock_out)->format('H:i') ?? '' }}
                </td>
            </tr>

            {{-- 休憩一覧 --}}
            @foreach($breaks as $i => $break)
            <tr>
                <th>{{ $i === 0 ? '休憩' : '' }}</th>
                <td>
                    {{ optional($break->break_start)->format('H:i') ?? '' }}
                    <span class="time-separator">～</span>
                    {{ optional($break->break_end)->format('H:i') ?? '' }}
                </td>
            </tr>
            @endforeach

            {{-- 追加休憩入力 --}}
            <tr>
                <th>休憩２</th>
                <td>
                    <input type="time" class="no-time-picker" {{ $isPending ? 'disabled' : '' }}>
                    <span class="time-separator">～</span>
                    <input type="time" class="no-time-picker" {{ $isPending ? 'disabled' : '' }}>
                </td>
            </tr>

            {{-- 備考 --}}
            <tr>
                <th>備考</th>
                <td>
                    <textarea rows="3" {{ $isPending ? 'disabled' : '' }}></textarea>
                </td>
            </tr>

        </tbody>
    </table>

    {{-- ボタン制御 --}}
    <div class="detail-footer">

        @if($isPending)
        <p class="pending-message">
            ＊ 承認待ちのため修正はできません。
        </p>
        @else
        <button class="btn-delete">削除</button>
        <button class="btn-edit">修正</button>
        @endif

    </div>

</div>

@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/request_detail.css') }}">
@endsection

@section('content')

<div class="attendance-list-wrapper">

    <h1 class="page-title">申請詳細</h1>

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
                    @if($afterCorrection)
                    @php
                    $date = \Carbon\Carbon::parse($afterCorrection->after_work_date);
                    @endphp
                    <span class="date-year">{{ $date->format('Y年') }}</span>
                    <span class="date-month">{{ $date->format('n月') }}</span>
                    <span class="date-day">{{ $date->format('j日') }}</span>
                    @endif
                </td>
            </tr>

            {{-- 出勤・退勤 --}}
            <tr>
                <th>出勤・退勤</th>
                <td>
                    {{ \Carbon\Carbon::parse($afterCorrection->after_clock_in)->format('H:i') }}
                    <span class="time-separator">～</span>
                    {{ \Carbon\Carbon::parse($afterCorrection->after_clock_out)->format('H:i') }}
                </td>
            </tr>

            {{-- 休憩（複数） --}}
            @foreach($afterBreaks as $i => $break)
            <tr>
                <th>{{ $i === 0 ? '休憩' : '' }}</th>
                <td>
                    {{ \Carbon\Carbon::parse($break->after_break_start)->format('H:i') }}
                    <span class="time-separator">～</span>
                    {{ \Carbon\Carbon::parse($break->after_break_end)->format('H:i') }}
                </td>
            </tr>
            @endforeach

            {{-- 備考 --}}
            <tr>
                <th>備考</th>
                <td>{{ $correction->reason }}</td>
            </tr>

        </tbody>
    </table>

    {{-- ===== 下部メッセージ・ボタン制御 ===== --}}
    <div class="detail-footer">

        @if(!$isApproved)
        <p class="pending-message">
            ＊ 承認待ちのため修正はできません。
        </p>
        @endif

    </div>

</div>

@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="attendance-list-wrapper">

    <h1 class="page-title">勤怠詳細</h1>

    {{-- 修正・削除 共通フォーム --}}
    <form method="POST" action="{{ route('attendance.detail.update') }}">
        @csrf

        {{-- 対象日 --}}
        <input type="hidden" name="date" value="{{ $date->format('Y-m-d') }}">

        <table class="attendance-table">
            <tbody>

                {{-- 名前 --}}
                <tr>
                    <th>名前</th>
                    <td>{{ $user->name }}</td>
                </tr>

                {{-- 日付（表示のみ） --}}
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
                        <input
                            type="time"
                            class="no-time-picker"
                            name="clock_in"
                            value="{{ optional($attendance?->clock_in)->format('H:i') ?? '' }}"
                            {{ $isPending ? 'disabled' : '' }}>

                        <span class="time-separator">～</span>

                        <input
                            type="time"
                            class="no-time-picker"
                            name="clock_out"
                            value="{{ optional($attendance?->clock_out)->format('H:i') ?? '' }}"
                            {{ $isPending ? 'disabled' : '' }}>
                    </td>
                </tr>

                {{-- 休憩（複数） --}}
                @foreach($breaks as $i => $break)
                <tr>
                    <th>{{ $i === 0 ? '休憩' : '' }}</th>
                    <td>
                        <input
                            type="time"
                            class="no-time-picker"
                            name="breaks[{{ $i }}][start]"
                            value="{{ optional($break->break_start)->format('H:i') ?? '' }}"
                            {{ $isPending ? 'disabled' : '' }}>

                        <span class="time-separator">～</span>

                        <input
                            type="time"
                            class="no-time-picker"
                            name="breaks[{{ $i }}][end]"
                            value="{{ optional($break->break_end)->format('H:i') ?? '' }}"
                            {{ $isPending ? 'disabled' : '' }}>
                    </td>
                </tr>
                @endforeach

                {{-- 追加休憩（休憩２） --}}
                <tr>
                    <th>休憩２</th>
                    <td>
                        <input
                            type="time"
                            class="no-time-picker"
                            name="extra_break[start]"
                            {{ $isPending ? 'disabled' : '' }}>

                        <span class="time-separator">～</span>

                        <input
                            type="time"
                            class="no-time-picker"
                            name="extra_break[end]"
                            {{ $isPending ? 'disabled' : '' }}>
                    </td>
                </tr>

                {{-- 備考 --}}
                <tr>
                    <th>備考</th>
                    <td>
                        <textarea
                            name="reason"
                            rows="3"
                            {{ $isPending ? 'disabled' : '' }}>{{ old('reason') }}</textarea>
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

            {{-- 削除ボタン（勤怠があるときのみ） --}}
            @if($attendance)
            <button
                type="submit"
                name="action"
                value="delete"
                class="btn-delete">
                削除
            </button>
            @endif

            {{-- 修正ボタン --}}
            <button
                type="submit"
                name="action"
                value="edit"
                class="btn-edit">
                修正
            </button>

            @endif

        </div>

    </form>

</div>

@endsection
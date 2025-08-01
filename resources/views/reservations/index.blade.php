@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">予約一覧</h2>
@endsection

@section('content')
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($reservations->isEmpty())
            <p>予約はまだありません。</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">部屋名</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">チェックイン
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">チェックアウト
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">人数</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ optional($reservation->room)->name ?? '不明' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->check_in_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->check_out_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->guest_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

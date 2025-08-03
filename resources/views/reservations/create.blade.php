@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">新規予約登録</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded" role="alert" aria-live="polite">
                {{ session('success') }}
            </div>
        @endif

        <x-reservation-form
            :rooms="$rooms"
            :action="route('reservations.store')"
            method="POST"
            buttonText="予約する"
        />
    </div>
@endsection

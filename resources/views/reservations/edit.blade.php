@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        予約編集
    </h2>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto py-6">
        <x-reservation-form
            :rooms="$rooms"
            :room_id="$reservation->room_id"
            :check_in_date="$reservation->check_in_date"
            :check_out_date="$reservation->check_out_date"
            :guest_count="$reservation->guest_count"
            :action="route('reservations.update', $reservation->id)"
            method="PUT"
            buttonText="更新する"
        />
    </div>
@endsection

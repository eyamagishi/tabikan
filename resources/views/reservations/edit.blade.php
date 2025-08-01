@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        予約編集
    </h2>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto py-6">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="room_id" class="block text-gray-700">部屋</label>
                <select id="room_id" name="room_id" class="border rounded w-full p-2">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="check_in_date" class="block text-gray-700">チェックイン日</label>
                <input type="date" id="check_in_date" name="check_in_date"
                    value="{{ old('check_in_date', $reservation->check_in_date) }}" class="border rounded w-full p-2">
                @error('check_in_date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="check_out_date" class="block text-gray-700">チェックアウト日</label>
                <input type="date" id="check_out_date" name="check_out_date"
                    value="{{ old('check_out_date', $reservation->check_out_date) }}" class="border rounded w-full p-2">
                @error('check_out_date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="guest_count" class="block text-gray-700">人数</label>
                <input type="number" id="guest_count" name="guest_count" min="1"
                    value="{{ old('guest_count', $reservation->guest_count) }}" class="border rounded w-full p-2">
                @error('guest_count')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-150">
                    更新する
                </button>
            </div>            
        </form>
    </div>
@endsection

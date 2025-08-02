@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        予約編集
    </h2>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto py-6" x-data="reservationForm()" x-init="init()">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded" role="alert" aria-live="polite">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}" novalidate>
            @csrf
            @method('PUT')

            {{-- 部屋選択 --}}
            <div class="mb-4">
                <label for="room_id" class="block text-gray-700 font-medium mb-1">部屋</label>
                <select id="room_id" name="room_id"
                    class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required
                    aria-describedby="roomIdError" aria-invalid="{{ $errors->has('room_id') ? 'true' : 'false' }}">
                    <option value="" disabled {{ old('room_id', $reservation->room_id) ? '' : 'selected' }}>
                        選択してください
                    </option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}"
                            {{ old('room_id', $reservation->room_id) == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}（最大{{ $room->capacity }}名）
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p id="roomIdError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- チェックイン日 --}}
            <div class="mb-4">
                <label for="check_in_date" class="block text-gray-700 font-medium mb-1">チェックイン日</label>
                <input type="date" id="check_in_date" name="check_in_date" x-model="checkIn" @input="validateDates"
                    class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required
                    aria-describedby="checkInError" aria-invalid="{{ $errors->has('check_in_date') ? 'true' : 'false' }}">
                @error('check_in_date')
                    <p id="checkInError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- チェックアウト日 --}}
            <div class="mb-4">
                <label for="check_out_date" class="block text-gray-700 font-medium mb-1">チェックアウト日</label>
                <input type="date" id="check_out_date" name="check_out_date" x-model="checkOut" @input="validateDates"
                    class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required
                    aria-describedby="checkOutError dateError"
                    aria-invalid="{{ $errors->has('check_out_date') ? 'true' : 'false' }}">
                @error('check_out_date')
                    <p id="checkOutError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror

                {{-- Alpine.jsバリデーションエラー --}}
                <template x-if="dateError">
                    <p id="dateError" class="text-red-600 text-sm mt-1" role="alert">
                        チェックアウト日はチェックイン日以降の日付を選んでください。
                    </p>
                </template>
            </div>

            {{-- 宿泊人数 --}}
            <div class="mb-6">
                <label for="guest_count" class="block text-gray-700 font-medium mb-1">人数</label>
                <input type="number" id="guest_count" name="guest_count" min="1" max="10"
                    value="{{ old('guest_count', $reservation->guest_count) }}"
                    class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required
                    aria-describedby="guestCountError" aria-invalid="{{ $errors->has('guest_count') ? 'true' : 'false' }}">
                @error('guest_count')
                    <p id="guestCountError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- 更新ボタン --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="dateError">
                    更新する
                </button>
            </div>
        </form>
    </div>

    <script>
        function reservationForm() {
            return {
                checkIn: '{{ old('check_in_date', $reservation->check_in_date) }}',
                checkOut: '{{ old('check_out_date', $reservation->check_out_date) }}',
                dateError: false,
                validateDates() {
                    if (this.checkIn && this.checkOut) {
                        this.dateError = new Date(this.checkOut) <= new Date(this.checkIn);
                    } else {
                        this.dateError = false;
                    }
                },
                init() {
                    this.validateDates();
                }
            }
        }
    </script>
@endsection

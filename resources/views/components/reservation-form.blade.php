<div x-data="reservationForm({
    checkIn: {{ json_encode(old('check_in_date', $checkInDate ?? '')) }},
    checkOut: {{ json_encode(old('check_out_date', $checkOutDate ?? '')) }},
    guestCount: {{ json_encode(old('guest_count', $guestCount ?? 1)) }}
})" x-init="init()">
    <form method="{{ $method ?? 'POST' }}" action="{{ $action }}" novalidate>
        @csrf
        @if (isset($method) && in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
            @method($method)
        @endif

        {{-- 部屋選択 --}}
        <div class="mb-4">
            <label for="room_id" class="block mb-1 font-medium text-gray-700">部屋を選択</label>
            <select name="room_id" id="room_id" required aria-describedby="roomIdError"
                aria-invalid="{{ $errors->has('room_id') ? 'true' : 'false' }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="" disabled {{ empty(old('room_id', $roomId ?? '')) ? 'selected' : '' }}>
                    選択してください
                </option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ old('room_id', $roomId ?? '') == $room->id ? 'selected' : '' }}>
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
            <label for="check_in_date" class="block mb-1 font-medium text-gray-700">チェックイン日</label>
            <input type="date" name="check_in_date" id="check_in_date" x-model="checkIn" @input="validateDates"
                required aria-describedby="checkInError"
                aria-invalid="{{ $errors->has('check_in_date') ? 'true' : 'false' }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('check_in_date')
                <p id="checkInError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
            @enderror
        </div>

        {{-- チェックアウト日 --}}
        <div class="mb-4">
            <label for="check_out_date" class="block mb-1 font-medium text-gray-700">チェックアウト日</label>
            <input type="date" name="check_out_date" id="check_out_date" x-model="checkOut" @input="validateDates"
                required aria-describedby="checkOutError dateError"
                aria-invalid="{{ $errors->has('check_out_date') ? 'true' : 'false' }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('check_out_date')
                <p id="checkOutError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
            @enderror
            <template x-if="dateError">
                <p id="dateError" class="text-red-600 text-sm mt-1" role="alert">
                    チェックアウト日はチェックイン日以降の日付を選んでください。
                </p>
            </template>
        </div>

        {{-- 宿泊人数 --}}
        <div class="mb-6">
            <label for="guest_count" class="block mb-1 font-medium text-gray-700">宿泊人数</label>
            <input type="number" name="guest_count" id="guest_count" min="1" max="10"
                x-model.number="guestCount" @input="validateGuestCount" required aria-describedby="guestCountError"
                aria-invalid="{{ $errors->has('guest_count') ? 'true' : 'false' }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('guest_count')
                <p id="guestCountError" class="text-red-600 text-sm mt-1" role="alert">{{ $message }}</p>
            @enderror
            <template x-if="guestCountError">
                <p class="text-red-600 text-sm mt-1" role="alert">
                    宿泊人数は1人以上10人以下で指定してください。
                </p>
            </template>
        </div>

        {{-- 送信ボタン --}}
        <button type="submit"
            class="bg-blue-600 text-white font-semibold px-6 py-3 rounded shadow
                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400
                   focus:ring-offset-2 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed"
            :disabled="dateError || guestCountError">
            {{ $buttonText ?? '送信' }}
        </button>
    </form>
</div>

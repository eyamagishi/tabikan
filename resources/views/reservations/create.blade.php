@extends('layouts.app')

@section('content')
    <div class="container" x-data="reservationForm()">
        <h1>新規予約登録</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form @submit.prevent="submitForm" novalidate>
            @csrf

            <div class="mb-3">
                <label for="room_id">部屋を選択</label>
                <select name="room_id" id="room_id" class="form-control" x-model="room_id" required>
                    <option value="">選択してください</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}（最大{{ $room->capacity }}名）</option>
                    @endforeach
                </select>
                <template x-if="errors.room_id">
                    <div class="text-danger" x-text="errors.room_id"></div>
                </template>
            </div>

            <div class="mb-3">
                <label for="check_in_date">チェックイン日</label>
                <input type="date" id="check_in_date" class="form-control" x-model="check_in_date" required>
                <template x-if="errors.check_in_date">
                    <div class="text-danger" x-text="errors.check_in_date"></div>
                </template>
            </div>

            <div class="mb-3">
                <label for="check_out_date">チェックアウト日</label>
                <input type="date" id="check_out_date" class="form-control" x-model="check_out_date" required>
                <template x-if="errors.check_out_date">
                    <div class="text-danger" x-text="errors.check_out_date"></div>
                </template>
            </div>

            <div class="mb-3">
                <label for="guest_count">宿泊人数</label>
                <input type="number" id="guest_count" class="form-control" x-model="guest_count" min="1" required>
                <template x-if="errors.guest_count">
                    <div class="text-danger" x-text="errors.guest_count"></div>
                </template>
            </div>

            <button type="submit" class="btn btn-primary">予約する</button>
        </form>
    </div>

    <script>
        function reservationForm() {
            return {
                room_id: '',
                check_in_date: '',
                check_out_date: '',
                guest_count: '',
                errors: {},

                submitForm() {
                    this.errors = {};

                    // バリデーション
                    if (!this.room_id) this.errors.room_id = '部屋を選択してください。';
                    if (!this.check_in_date) this.errors.check_in_date = 'チェックイン日を入力してください。';
                    if (!this.check_out_date) this.errors.check_out_date = 'チェックアウト日を入力してください。';
                    if (this.check_in_date && this.check_out_date && this.check_in_date > this.check_out_date) {
                        this.errors.check_out_date = 'チェックアウト日はチェックイン日以降にしてください。';
                    }
                    if (!this.guest_count || this.guest_count < 1) {
                        this.errors.guest_count = '1人以上の人数を入力してください。';
                    }

                    if (Object.keys(this.errors).length === 0) {
                        $el = document.createElement('form');
                        $el.method = 'POST';
                        $el.action = "{{ route('reservations.store') }}";
                        $el.innerHTML = `
                            @csrf
                            <input type="hidden" name="room_id" value="${this.room_id}">
                            <input type="hidden" name="check_in_date" value="${this.check_in_date}">
                            <input type="hidden" name="check_out_date" value="${this.check_out_date}">
                            <input type="hidden" name="guest_count" value="${this.guest_count}">
                        `;
                        document.body.appendChild($el);
                        $el.submit();
                    }
                }
            };
        }
    </script>
@endsection

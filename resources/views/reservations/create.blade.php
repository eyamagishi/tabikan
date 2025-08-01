@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>新規予約登録</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf

            <div class="mb-3">
                <label for="room_id">部屋を選択</label>
                <select name="room_id" id="room_id" class="form-control" required>
                    <option value="">選択してください</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}（最大{{ $room->capacity }}名）</option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="check_in_date">チェックイン日</label>
                <input type="date" name="check_in_date" id="check_in_date" class="form-control" required>
                @error('check_in_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="check_out_date">チェックアウト日</label>
                <input type="date" name="check_out_date" id="check_out_date" class="form-control" required>
                @error('check_out_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="guest_count">宿泊人数</label>
                <input type="number" name="guest_count" id="guest_count" class="form-control" min="1" required>
                @error('guest_count')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">予約する</button>
        </form>
    </div>
@endsection

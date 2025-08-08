<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class ReservationService
{
    /**
     * ユーザー自身の予約一覧を取得する。
     *
     * @return Collection
     */
    public function getUserReservations(): Collection
    {
        return Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    /**
     * 予約作成に利用する全ての部屋情報を取得する。
     *
     * @return Collection
     */
    public function getAllRooms(): Collection
    {
        return Room::all();
    }

    /**
     * 新しい予約を作成する。
     *
     * @param  array<string, mixed> $data
     * @return Reservation
     */
    public function createReservation(array $data): Reservation
    {
        return Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $data['room_id'],
            'check_in_date' => $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'guest_count' => $data['guest_count'],
        ]);
    }

    /**
     * 既存の予約情報を更新する。
     *
     * @param  Reservation          $reservation
     * @param  array<string, mixed> $data
     * @return bool
     */
    public function updateReservation(Reservation $reservation, array $data): bool
    {
        return $reservation->update($data);
    }
}

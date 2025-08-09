<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    /**
     * ユーザーが予約一覧を閲覧できるかどうかを判定
     *
     * @param  User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * ユーザーが特定の予約を閲覧できるかどうかを判定
     *
     * @param  User        $user
     * @param  Reservation $reservation
     * @return bool
     */
    public function view(User $user, Reservation $reservation): bool
    {
        return false;
    }

    /**
     * ユーザーが予約を作成できるかどうかを判定
     *
     * @param  User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * ユーザーが予約を更新できるかどうかを判定
     *
     * @param  User        $user
     * @param  Reservation $reservation
     * @return bool
     */
    public function update(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }

    /**
     * ユーザーが予約を削除できるかどうかを判定
     *
     * @param  User        $user
     * @param  Reservation $reservation
     * @return bool
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        return false;
    }

    /**
     * ユーザーが予約を復元できるかどうかを判定
     *
     * @param  User        $user
     * @param  Reservation $reservation
     * @return bool
     */
    public function restore(User $user, Reservation $reservation): bool
    {
        return false;
    }

    /**
     * ユーザーが予約を完全に削除できるかどうかを判定
     *
     * @param  User        $user
     * @param  Reservation $reservation
     * @return bool
     */
    public function forceDelete(User $user, Reservation $reservation): bool
    {
        return false;
    }
}

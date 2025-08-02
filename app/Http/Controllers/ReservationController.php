<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Room;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * ユーザー自身の予約一覧を表示する。
     *
     * @return View
     */
    public function index(): View
    {
        $reservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * 新しい予約作成画面を表示する。
     *
     * @return View
     */
    public function create(): View
    {
        $rooms = Room::all();

        return view('reservations.create', compact('rooms'));
    }

    /**
     * 新しい予約を保存する。
     *
     * @param  StoreReservationRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guest_count' => $validated['guest_count'],
        ]);

        return redirect()->route('reservations.create')->with('success', '予約が登録されました。');
    }

    /**
     * 指定された予約の編集画面を表示する。
     *
     * @param  Reservation  $reservation
     * @return View
     */
    public function edit(Reservation $reservation): View
    {
        $this->authorize('update', $reservation);

        $rooms = Room::all();

        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    /**
     * 既存の予約情報を更新する。
     *
     * @param  UpdateReservationRequest  $request
     * @param  Reservation  $reservation
     * @return RedirectResponse
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $this->authorize('update', $reservation);

        $reservation->update($request->validated());

        return redirect()->route('reservations.index')->with('success', '予約を更新しました。');
    }
}

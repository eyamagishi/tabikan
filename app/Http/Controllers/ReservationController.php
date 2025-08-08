<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * コンストラクタ。
     * 
     * @param ReservationService $reservationService
     */
    public function __construct(
        private ReservationService $reservationService
    ) {}

    /**
     * ユーザー自身の予約一覧を表示する。
     *
     * @return View
     */
    public function index(): View
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations */
        $reservations = $this->reservationService->getUserReservations();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * 新しい予約作成画面を表示する。
     *
     * @return View
     */
    public function create(): View
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Room> $rooms */
        $rooms = $this->reservationService->getAllRooms();

        return view('reservations.create', compact('rooms'));
    }

    /**
     * 新しい予約を保存する。
     *
     * @param  StoreReservationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $this->reservationService->createReservation($request->validated());

        return redirect()->route('reservations.create')->with('success', '予約が登録されました。');
    }

    /**
     * 指定された予約の編集画面を表示する。
     *
     * @param  Reservation $reservation
     * @return View
     */
    public function edit(Reservation $reservation): View
    {
        $this->authorize('update', $reservation);

        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Room> $rooms */
        $rooms = $this->reservationService->getAllRooms();

        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    /**
     * 既存の予約情報を更新する。
     *
     * @param  UpdateReservationRequest $request
     * @param  Reservation              $reservation
     * @return RedirectResponse
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $this->authorize('update', $reservation);

        $this->reservationService->updateReservation($reservation, $request->validated());

        return redirect()->route('reservations.index')->with('success', '予約を更新しました。');
    }
}

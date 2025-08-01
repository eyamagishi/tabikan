<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $messages = [
            'room_id.required' => '部屋を選択してください。',
            'room_id.exists' => '選択した部屋は存在しません。',
            'check_in_date.required' => 'チェックイン日を入力してください。',
            'check_in_date.date' => '正しい日付形式で入力してください。',
            'check_in_date.after_or_equal' => 'チェックイン日は今日以降の日付を指定してください。',
            'check_out_date.required' => 'チェックアウト日を入力してください。',
            'check_out_date.date' => '正しい日付形式で入力してください。',
            'check_out_date.after' => 'チェックアウト日はチェックイン日より後の日付を指定してください。',
            'guest_count.required' => '宿泊人数を入力してください。',
            'guest_count.integer' => '宿泊人数は整数で入力してください。',
            'guest_count.min' => '宿泊人数は最低1人以上にしてください。',
            'guest_count.max' => '宿泊人数は最大10人までです。',
        ];

        $validatedData = $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:10'],
        ], $messages);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $validatedData['room_id'],
            'check_in_date' => $validatedData['check_in_date'],
            'check_out_date' => $validatedData['check_out_date'],
            'guest_count' => $validatedData['guest_count'],
        ]);

        return redirect()->route('reservations.create')->with('success', '予約が登録されました。');
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $rooms = Room::all();

        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation); // 本人以外をブロック

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_count' => 'required|integer|min:1',
        ]);

        $reservation->update($request->only([
            'room_id',
            'check_in_date',
            'check_out_date',
            'guest_count',
        ]));

        return redirect()->route('reservations.index')->with('success', '予約を更新しました。');
    }
}

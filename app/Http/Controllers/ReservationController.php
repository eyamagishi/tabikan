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
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_count' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
        ]);

        return redirect()->route('reservations.create')->with('success', '予約が登録されました。');
    }
}

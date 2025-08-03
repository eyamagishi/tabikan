<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReservationForm extends Component
{
    public $rooms;
    public $roomId;
    public $checkInDate;
    public $checkOutDate;
    public $guestCount;
    public $action;
    public $method;
    public $buttonText;

    public function __construct(
        $rooms,
        $roomId = null,
        $checkInDate = null,
        $checkOutDate = null,
        $guestCount = 1,
        $action,
        $method = 'POST',
        $buttonText = '送信'
    ) {
        $this->rooms = $rooms;
        $this->roomId = $roomId;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
        $this->guestCount = $guestCount;
        $this->action = $action;
        $this->method = $method;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.reservation-form');
    }
}

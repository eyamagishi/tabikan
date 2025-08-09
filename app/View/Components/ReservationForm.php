<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ReservationForm extends Component
{
    public Collection $rooms;
    public ?int $roomId;
    public ?string $checkInDate;
    public ?string $checkOutDate;
    public int $guestCount;
    public string $action;
    public string $method;
    public string $buttonText;

    /**
     * 新しいコンポーネントインスタンスを生成する。
     * 
     * @param Collection  $rooms
     * @param string      $action
     * @param int|null    $roomId
     * @param string|null $checkInDate
     * @param string|null $checkOutDate
     * @param int         $guestCount
     * @param string      $method
     * @param string      $buttonText
     */
    public function __construct(
        Collection $rooms,
        string $action,
        ?int $roomId = null,
        ?string $checkInDate = null,
        ?string $checkOutDate = null,
        int $guestCount = 1,
        string $method = 'POST',
        string $buttonText = '送信'
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

    /**
     * コンポーネントのビューを取得する。
     * 
     * @return View
     */
    public function render(): View
    {
        return view('components.reservation-form');
    }
}

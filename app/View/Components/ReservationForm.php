<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

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
     * @param Collection $rooms 部屋のコレクション
     * @param string $action フォームの送信先URL
     * @param int|null $roomId 選択中の部屋ID（省略可）
     * @param string|null $checkInDate チェックイン日（省略可）
     * @param string|null $checkOutDate チェックアウト日（省略可）
     * @param int $guestCount 宿泊人数（デフォルト1）
     * @param string $method フォーム送信のHTTPメソッド（デフォルトPOST）
     * @param string $buttonText 送信ボタンのテキスト（デフォルト「送信」）
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
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.reservation-form');
    }
}

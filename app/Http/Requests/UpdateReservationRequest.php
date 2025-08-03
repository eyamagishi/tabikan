<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateReservationRequest
 *
 * バリデーションルールとエラーメッセージを定義し、
 * 予約情報の更新リクエストを検証するフォームリクエストクラス。
 *
 * @package App\Http\Requests
 */
class UpdateReservationRequest extends FormRequest
{
    /**
     * リクエストが許可されているかどうかを判定
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 更新時に適用するバリデーションルール
     * 
     * @return array<string, string|string[]>
     */
    public function rules(): array
    {
        return [
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    /**
     * バリデーションエラーメッセージ
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
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
    }
}

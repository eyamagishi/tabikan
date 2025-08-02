<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreReservationRequest
 *
 * バリデーションルールとエラーメッセージを定義し、
 * 予約情報の新規登録リクエストを検証するフォームリクエストクラス。
 *
 * @package App\Http\Requests
 */
class StoreReservationRequest extends FormRequest
{
    /**
     * このリクエストを行うユーザーが認可されているか判定する。
     *
     * @return bool 認可されている場合はtrue、そうでなければfalse。
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに対するバリデーションルールを取得する。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *         各入力項目のバリデーションルール配列
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
     * バリデーション失敗時に返すエラーメッセージを定義する。
     *
     * @return array<string, string> フィールドごとのカスタムエラーメッセージ
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

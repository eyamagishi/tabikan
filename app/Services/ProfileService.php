<?php

namespace App\Services;

use App\Models\User;

class ProfileService
{
    /**
     * 指定されたユーザーのプロフィール情報を更新
     * 
     * @param  User                 $user
     * @param  array<string, mixed> $data
     * @return User
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            // メールアドレスが変更された場合、認証日時をリセットする
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }

    /**
     * 指定されたユーザーのプロフィール（アカウント）を削除
     * 
     * @param  User $user
     * @return void
     */
    public function deleteProfile(User $user): void
    {
        $user->delete();
    }
}

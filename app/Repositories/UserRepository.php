<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function update(User $user, array $data): User
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
     * @inheritDoc
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}

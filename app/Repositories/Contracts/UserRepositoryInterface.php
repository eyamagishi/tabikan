<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * 指定されたユーザーのプロフィール情報を更新
     * 
     * @param  User                 $user
     * @param  array<string, mixed> $data
     * @return User
     */
    public function update(User $user, array $data): User;

    /**
     * 指定されたユーザーのプロフィール（アカウント）を削除
     * 
     * @param  User $user
     * @return void
     */
    public function delete(User $user): void;
}

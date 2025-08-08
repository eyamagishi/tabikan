<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class ProfileService
{
    /**
     * コンストラクタ。
     * 
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * 指定されたユーザーのプロフィール情報を更新
     * 
     * @param  User                 $user
     * @param  array<string, mixed> $data
     * @return User
     */
    public function updateProfile(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    /**
     * 指定されたユーザーのプロフィール（アカウント）を削除
     * 
     * @param  User $user
     * @return void
     */
    public function deleteProfile(User $user): void
    {
        $this->userRepository->delete($user);
    }
}

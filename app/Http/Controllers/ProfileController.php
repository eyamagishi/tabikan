<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /** @var ProfileService $profileService */
    protected ProfileService $profileService;

    /**
     * コンストラクタ。
     * 
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display the user's profile form.
     * 
     * @return View
     */
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * 
     * @param  UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->profileService->updateProfile($user, $request->validated());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     * 
     * @param  DeleteProfileRequest $request
     * @return RedirectResponse
     */
    public function destroy(DeleteProfileRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        Auth::logout();

        $this->profileService->deleteProfile($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

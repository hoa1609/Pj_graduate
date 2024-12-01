<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        // Xác thực mật khẩu người dùng
        $user = Auth::user();
        $password = $request->input('password');

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors([
                'userDeletion.password' => __('Mật khẩu không chính xác.'),
            ]);
        }
        $user->delete();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', __('Tài khoản của bạn đã được xóa thành công.'));
    }
}

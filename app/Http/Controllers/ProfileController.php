<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
    $validated = $request->validated();

    // Handle file upload
    if ($request->hasFile('profile_photo')) {
        $user = $request->user(); // Get user instance once to avoid multiple calls
        
        // Delete old photo if exists
        if ($user->profile_photo) {
            $oldPhotoPath = str_replace('storage/', '', $user->profile_photo);
            Storage::disk('public')->delete($oldPhotoPath);
        }
    
        $path = $request->file('profile_photo')->store('profile-photos', 'public');
        $validated['profile_photo'] = $path;
    }
    $request->user()->fill($validated);

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus foto profil saat akun dihapus
        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function deletePhoto(Request $request)
    {
        $user = $request->user();
        
        if ($user->profile_photo) {
            try {
                // Hapus 'storage/' dari path jika ada
                $oldPhotoPath = str_replace('storage/', '', $user->profile_photo);
                
                // Hapus file dari storage
                Storage::disk('public')->delete($oldPhotoPath);
                
                // Update database
                $user->profile_photo = null;
                $user->save();
                
                return response()->json(['success' => true]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus foto profil: ' . $e->getMessage()
                ], 500);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada foto profil yang bisa dihapus'
        ], 400);
    }
}
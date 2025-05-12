<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profiles\ProfileUpdateRequest;
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
        $user = $request->user();

        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                $this->deleteProfilePhoto($user);
            }

            // Create user-specific folder and store new photo
            $folderName = 'user-' . $user->id;
            $path = $request->file('profile_photo')->store(
                "profile-photos/{$folderName}", 
                'public'
            );
            
            $validated['profile_photo'] = $path;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

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

        // Delete entire user's profile photo folder
        if ($user->profile_photo) {
            $folderName = 'user-' . $user->id;
            Storage::disk('public')->deleteDirectory("profile-photos/{$folderName}");
        }

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Delete the user's profile photo.
     */
    public function deletePhoto(Request $request)
    {
        $user = $request->user();
        
        if ($user->profile_photo) {
            try {
                $this->deleteProfilePhoto($user);
                
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

    /**
     * Helper method to delete profile photo
     */
    private function deleteProfilePhoto($user)
    {
        if ($user->profile_photo) {
            $oldPhotoPath = str_replace('storage/', '', $user->profile_photo);
            Storage::disk('public')->delete($oldPhotoPath);
            $user->profile_photo = null;
            $user->save();
        }
    }
}
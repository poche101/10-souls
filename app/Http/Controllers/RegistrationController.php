<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class RegistrationController extends Controller
{
    private function getImageManager(): ImageManager
    {
        // Use Imagick if available, fall back to GD
        if (extension_loaded('imagick')) {
            return new ImageManager(new ImagickDriver());
        }
        return new ImageManager(new GdDriver());
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'in:Pastor,Evangelist,Brother,Sister,Deacon,Deaconess'],
            'full_name'        => ['required', 'string', 'max:255'],
            'phone_number'     => ['required', 'string', 'max:20'],
            'cell'             => ['required', 'string', 'max:100'],
            'church'           => ['required', 'string', 'max:255'],
            'group'            => ['required', 'string', 'max:100'],
            'souls_commitment' => ['required', 'integer', 'min:1'],
        ]);

        $registration = Registration::create($data);

        return redirect()->route('avatar.show', $registration->id);
    }

    public function avatarShow(Registration $registration)
    {
        return view('avatar', compact('registration'));
    }

   public function avatarUpload(Request $request, Registration $registration)
{
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', '120');

    $request->validate([
        'photo' => ['required', 'file', 'max:5120'],
    ]);

    $file = $request->file('photo');

    $detectedMime = $file->getMimeType();

    if (!in_array($detectedMime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid image type: ' . $detectedMime,
        ], 422);
    }

    $uploadedPath     = $file->store('temp', 'public');
    $fullUploadedPath = storage_path('app/public/' . $uploadedPath);
    $framePath        = public_path('images/10.png');

    try {
        $manager = new ImageManager(new GdDriver());

        // Scale frame down to 1050x1200 (exactly half) to save memory
        // while keeping full quality for sharing
        $frame = $manager->decodePath($framePath);
        $frame->scale(1050);
        $frameWidth  = $frame->width();  // 1050
        $frameHeight = $frame->height(); // 1200

        // ── Exact circle measurements at 1050x1200 ────────────
        // Original frame 2100x2400 scaled to half:
        // Circle diameter ≈ 54% of width = 1050 * 0.54 = 567px
        // Circle center X ≈ 50% of width = 525px
        // Circle center Y ≈ 42% of height = 504px
        $circleSize = 700;
        $offsetX    = 175;  // moved left from 205
        $offsetY    = 165;  // moved up from 185// increase → move down, decrease → move up

        // Load and crop user photo to exact circle size
        $userPhoto = $manager->decodePath($fullUploadedPath);
        $userPhoto->cover($circleSize, $circleSize);

        // Build composite
        $background = $manager->createImage($frameWidth, $frameHeight);
        $background->fill('#3b0764');
        $background->insert($userPhoto, $offsetX, $offsetY);
        $background->insert($frame, 0, 0);

        // Free memory
        unset($userPhoto, $frame);

        // Save
        $filename = 'avatar_' . $registration->id . '_' . time() . '.png';
        $savePath = storage_path('app/public/avatars/' . $filename);

        if (!Storage::disk('public')->exists('avatars')) {
            Storage::disk('public')->makeDirectory('avatars');
        }

        $background->save($savePath);

        unset($background);

        // Clean up temp
        Storage::disk('public')->delete($uploadedPath);

        $registration->update(['avatar_path' => 'avatars/' . $filename]);

        return response()->json([
            'success'   => true,
            'image_url' => asset('storage/avatars/' . $filename),
            'filename'  => $filename,
        ]);

    } catch (\Exception $e) {
        \Log::error('Avatar generation failed: ' . $e->getMessage());
        Storage::disk('public')->delete($uploadedPath);

        return response()->json([
            'success' => false,
            'message' => 'Avatar generation failed: ' . $e->getMessage(),
        ], 500);
    }
}

    public function avatarDownload(Registration $registration)
    {
        if (!$registration->avatar_path) {
            abort(404, 'Avatar not found');
        }

        $path = storage_path('app/public/' . $registration->avatar_path);

        return response()->download(
            $path,
            '10souls10days_' . str_replace(' ', '_', $registration->full_name) . '.png'
        );
    }
}
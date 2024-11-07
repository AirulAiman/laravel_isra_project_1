<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestOrganizationController extends Controller
{
    // ====================================
    // READ
    // ====================================
    public function view()
    {
        $organizations = Organization::all();
        return view('admin.organizations.main', compact('organizations'));
    }

    // ====================================
    // CREATE
    // ====================================
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'org_name' => 'required|string|max:255',
                'org_logo' => 'nullable|image',
            ]);


            $organization = new Organization([
                'org_name' => $validated['org_name'],
                'org_id' => random_int(10, 90),
            ]);


            if ($request->hasFile('org_logo')) {
                // $organization->org_logo = $request->file('org_logo')->store('org_logo', 'public');
                $image = $request->file('org_logo');
                $path = $image->store('org_logo', 'public');

                $this->resizeAndCropImage(storage_path('app/public/' . $path), 500, 500);

                $organization->org_logo = $path;
            }

            $organization->save();

            return redirect()->back()->with('success', 'Organization created successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the organization.']);
        }
    }

    // ====================================
    // UPDATE
    // ====================================
    public function update(Request $request, $org_id)
    {
        $organization = Organization::find($org_id);
        if (!$organization) {
            return redirect()->back()->withErrors(['error' => 'Organization not found']);
        }

        $validated = $request->validate([
            'org_name' => 'required|string|max:255',
        ]);

        $organization->org_name = $validated['org_name'];

        if ($request->hasFile('org_logo')) {
            $organization->org_logo = $this->handleImageUpload($request, 'org_logo');
        }

        $organization->save();
        return redirect()->back()->with('success', 'Organization updated successfully.');
    }

    // ====================================
    // FUNCTION DEPENDENCIES
    // ====================================

    // ------------------------------------
    // Handle image upload to storage and return the path
    // ------------------------------------
    private function handleImageUpload(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            return $request->file($fieldName)->store('org_logo', 'public');
        }
        return null;
    }

    // ------------------------------------
    // Resize and crop the image to a 1:1 aspect ratio
    // ------------------------------------
    private function resizeAndCropImage($filePath, $width, $height)
    {
        list($originalWidth, $originalHeight) = getimagesize($filePath);
        $src = imagecreatefromstring(file_get_contents($filePath));

        $minSize = min($originalWidth, $originalHeight);
        $srcX = ($originalWidth - $minSize) / 2;
        $srcY = ($originalHeight - $minSize) / 2;

        $dst = imagecreatetruecolor($width, $height);
        imagecopyresampled($dst, $src, 0, 0, $srcX, $srcY, $width, $height, $minSize, $minSize);

        imagejpeg($dst, $filePath);
        imagedestroy($src);
        imagedestroy($dst);
    }
}

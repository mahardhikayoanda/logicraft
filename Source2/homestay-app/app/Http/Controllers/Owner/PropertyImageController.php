<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function destroy($id)
    {
        $image = PropertyImage::findOrFail($id);

        // Pastikan hanya owner yang memiliki properti bisa menghapus
        if ($image->property->owner_id !== Auth::id()) {
            abort(403);
        }

        // Hapus file dari storage
        Storage::disk('public')->delete($image->image_path);

        // Hapus dari database
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}

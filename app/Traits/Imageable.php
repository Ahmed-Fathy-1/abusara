<?php

namespace App\Traits;

use App\Models\Trending;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Storage;

trait Imageable
{


    public function setImageAttribute($value,$oldImage= null)
    {
        if (isset($value)) {
            // Delete the old image if it exists
            if ($oldImage && $oldImage != NULL) {
                Storage::disk('public')->delete('uploads/images/' . $oldImage);
            }

            // Save the new image
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads/images');
            $value->move($destinationPath, $imageName);
            return  $imageName;
        }
    }

    








}

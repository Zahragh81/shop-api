<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //relationShips:

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function newGallery(Request $request)
    {
        if ($request->has('path')) {
            foreach ($request->path as $images) {

                $imageGalleryPath = Carbon::now()->microsecond . '.' . $images->extension();
                $images->storeAs('images/galleries', $imageGalleryPath, 'public');
                $this->galleries()->create([
                    'product_id' => $this->id,
                    'path' => $imageGalleryPath,
                    'mime' => $images->getClientMimeType(),
                ]);

            }
        }
    }

    public function deleteGallery(Gallery $gallery)
    {
        unlink(public_path('storage/images/galleries/'. $gallery->path));
        $gallery->delete();
    }

}

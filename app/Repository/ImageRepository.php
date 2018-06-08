<?php

namespace App\Repository ;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;


class ImageRepository
{

    public function store($request){
        // sauvegarde de l'image 

        $path = Storage::disk('images')->put('',$request->file('image'));

        //sauvegarde du thumbnail 

        $image = InterventionImage::make($request->file('image'))->widen(100);
        Storage::disk('thumbs')->put($path,$image->encode());

        // Sauvegarde dans la base de données 

        $image = new Image;
        $image->name = $path;
        $image->description = $request->description;
        $image->category_id = $request->category_id;
        $image->user_id = auth()->id() ;   // on réccupère l'id de l'utilisateur en cours
        $image->save();

    }

    public function getImagesForCategory($slug){

        return Image::latestWithUser()->whereHas('category', function ($query) use ($slug){
            $query->whereSlug($slug);
         })->paginate(config('app.pagination'));
        }
}
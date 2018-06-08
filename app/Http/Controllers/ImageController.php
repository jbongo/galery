<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Repository\ImageRepository;

class ImageController extends Controller
{
    
    private $repository;

    public function __construct(ImageRepository $repository){

        $this->repository = $repository;
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('images.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $categories = Category::all();
        $request->validate([
        "image" => 'required|image|max:2000',
        "category_id" => 'required|exists:categories,id',
        "description" =>'nullable|string|max:255'
        ]);

        $this->repository->store($request);
        return back()->with('ok',__("L'image a bien été enregistrée"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // on veut aficher les images par categorie
    public function category($slug){

        $category = Category::whereSlug($slug)->firstorFail();
        $images = $this->repository->getImagesForCategory($slug);

        $categories = Category::all();

        return view('home', compact('category','images','categories'));
    }

}

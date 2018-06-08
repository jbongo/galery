<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Category;

class HomeController extends Controller
{
  
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::LatestWithUser()->paginate(config('app.pagination'));
        $categories = Category::all();

        return view('home',compact('images','categories'));
    }
}

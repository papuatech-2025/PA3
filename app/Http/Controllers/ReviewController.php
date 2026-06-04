<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
   public function Review(){
        return view('Review.Review');
    }
}

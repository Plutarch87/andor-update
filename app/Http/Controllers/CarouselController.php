<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Carousel;
use Storage;

class CarouselController extends Controller
{

	protected $carousel;

	public function __construct(Carousel $carousel)
	{

	    $this->carousel = $carousel;
	}

    public function index()
    {
    	$carousel = Carousel::all();

    	return view('carousel.index', compact('carousel'));
    }

    public function store(Request $request)
    {
    	if(
    	    $request->file('img')->getClientMimeType() == 'image/jpg' ||
    	    $request->file('img')->getClientMimeType() == 'image/png' ||
    	    $request->file('img')->getClientMimeType() == 'image/jpeg'
    	   )
    	    {
		     $desPath = 'assets/images/carousel/';
		     $name = 'karusel'.$request->title.'.jpg';
	    	 $car = Carousel::where('title', $request->title)->first();	    	 
	    	 $car->delete();
		     if(file_exists($desPath.$name)){
				 unlink($desPath.$name);
		     }
		     if($request->file('img')->isValid()) {
		         $request->file('img')->move($desPath, $name);
    	     }
    	 } else {
    	     return response()->json("File must be in image format(.jpeg, .jpg, .png)", 405);
    	 }
    	$carousel = Carousel::create([
	    'title' => $request->title,
    	]);

    	return back();
    }
}

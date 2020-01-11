<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('previeuw.newcuppy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:34048',
        ]);

        //move image to public map
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        //get image location for filter
        $pad = public_path('images');
        $imgpad = "$pad". "/" . "$imageName";
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $imageName);

        //filter image
        $img = Image::make(file_get_contents($imgpad));
        unlink($imgpad);
        $img->greyscale();
        $img->contrast(80);
        $img->resize(300, 200);
        $img->sharpen(50);

        // rotate call
        $h = $img->height();
        $w = $img->width();
        $margin = $w / $h;
        if($margin > 1.4){
            $img->rotate(-90);
        }

        // save image
        $imageName = "$withoutExt.jpg";
        $newpad = "$pad/$withoutExt.jpg";
        $img->save($newpad);



        //remove background
        $img = imagecreatefromstring(file_get_contents($newpad));
        $white = imagecolorallocate($img, 255, 255, 255);
        imagecolortransparent($img, $white);
        $white = imagecolorallocate($img, 254, 254, 254);
        imagecolortransparent($img, $white);
        $white = imagecolorallocate($img, 253, 253, 253);
        imagecolortransparent($img, $white);
        $white = imagecolorallocate($img, 252, 252, 252);
        imagecolortransparent($img, $white);
        imagepng( $img, "$newpad");


        return back()
        ->with('success','You have successfully uploaded your desing .')
        ->with('image', $imageName);
    }

}



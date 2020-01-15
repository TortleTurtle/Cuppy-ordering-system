<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14048',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $pad = public_path('images');
        $imgpad = "$pad". "/" . "$imageName";
        $filetype = pathinfo($imgpad, PATHINFO_EXTENSION);

        // $test = new Image();
        $this->convertImageBlackAndWhite($imgpad, $filetype, $imageName);


        if ($filetype == 'gif' ){
            $imageName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $imageName);
            $imageName = "$imageName.png";
        }

        return back()
        ->with('success','You have successfully uploaded your design .')
        ->with('image', $imageName);
    }

    public function convertImageBlackAndWhite($orginImg, $filetype, $imageName) {
        if ($filetype == 'gif' || $filetype == 'jpg' || $filetype == 'png' || $filetype == 'jpeg'){
                if ($filetype == 'gif' ){
                    $orginImgwithoutGif = preg_replace('/\\.[^.\\s]{3,4}$/', '', $orginImg);
                    imagepng(imagecreatefromstring(file_get_contents($orginImg)), "$orginImgwithoutGif.png");
                    $orgingif = imagecreatefromstring(file_get_contents($orginImg));
                    imagedestroy($orgingif);
                    $orginImg = "$orginImgwithoutGif.png";
                }
            $img = imagecreatefromstring(file_get_contents($orginImg));
            imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
            imagefilter($img, IMG_FILTER_CONTRAST, -255); //then, apply a full contrast
            imagefilter($img, IMG_FILTER_NEGATE);
            imagepng( $img, $orginImg);

            $this->removebackground($img, $orginImg);

        } else if ($filetype == 'svg') {
            return back()->withErrors(["svg file $orginImg" , 'cant be converted']);
        } else {
            return back()->withErrors(["file $orginImg" , 'cant be converted']);
        }
    }

    public function removebackground($img, $orginImg){
        $img = imagecreatefromstring(file_get_contents($orginImg));
        $white = imagecolorallocate($img, 255, 255, 255);
        imagecolortransparent($img, $white);
        imagepng( $img, "$orginImg");

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }


}



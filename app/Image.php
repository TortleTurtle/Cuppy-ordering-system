<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function convert($orginImg, $img){
        imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
        imagefilter($img, IMG_FILTER_CONTRAST, -255); //then, apply a full contrast
        // imagefilter($img, IMG_FILTER_NEGATE);
        imagejpeg( $img, "$orginImg");
    }

    public function convertImageBlackAndWhite($orginImg, $filetype) {
        if ( $filetype == 'png'){
            $img = imagecreatefrompng($orginImg);
            $this->convert($orginImg, $img);
        } else if ($filetype == 'jpeg') {
            $img = imagecreatefromjpeg($orginImg);
            $this->convert($orginImg, $img);
        } else if ($filetype == 'gif'){
            $img = imagecreatefromstring(file_get_contents($orginImg));
            $this->convert($orginImg, $img);
        } else {
            $errors = "filetype can not be converted";
        }
    }

    public function remove($orginImg, $img){
        $img = imagecreatefromjpeg($orginImg); //or whatever loading function you need
        $white = imagecolorallocate($img, 255, 255, 255);
        $omg = imagecolortransparent($img, $white);
        dd($img);
        imagepng( $img, "$orginImg");
    }

    public function removeBackground($orginImg, $filetype){
        if ( $filetype == 'png'){
            $img = imagecreatefrompng($orginImg);
            $this->remove($orginImg, $img);
        } else if ($filetype == 'jpeg') {
            $img = imagecreatefromjpeg($orginImg);
            $this->remove($orginImg, $img);
        } else if ($filetype == 'sdfdsa') {
            $img = imagecreatefromjpeg($orginImg);
            $this->remove($orginImg, $img);
        } else {

        }
    }

}




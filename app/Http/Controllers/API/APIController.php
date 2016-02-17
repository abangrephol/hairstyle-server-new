<?php

namespace App\Http\Controllers\API;

use App\Models\Master\Category\Category;
use App\Models\Master\Frame\Frame;
use App\Models\Master\Hairstyle\Hairstyle;
use App\Models\Reseller\ApiKey\ApiKey;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller as BaseController;


class APIController extends BaseController
{
    use Helpers;

    public function check($imei,$apikey)
    {
        $apiCheck = ApiKey::where('api',$apikey)
            ->where('imei',$imei)
            ->count();
        if($apiCheck>0){
            $jsonArray = [
                "api" => true,
                "message" => ""
            ];
        }else{
            $jsonArray = [
                "api" => false,
                "message" => "Client not registered."
            ];
        }
        return $this->response->array($jsonArray) ;
    }

    public function hairstyles($apikey)
    {
        $hairstyle= Hairstyle::with('category')->get();
        $jsonArray = [];
        foreach($hairstyle as $hs){
            $jsonArray[] = [
                "hairstyleId"=>(int) $hs->id,
                "categoryId"=>(int)$hs->category_id,
                "hairstyleName"=>$hs->name,
                "categoryName"=>$hs->category->name,
                "image"=>url('/uploads/hairstyles/'.$hs->image),
                "hairsyleDescription"=>$hs->description,
                "categoryDescription"=>$hs->category->description,
                "xPoint" => (float) $hs->Xpoint,
                "yPoint" => (float) $hs->Ypoint,

            ];
        }
        return $this->response->array($jsonArray);
    }

    public function frames($apikey)
    {
        $frames= Frame::all();
        $jsonArray = [];
        foreach ($frames as $fs){
            $jsonArray[]= [
                "frameId" => $fs->id,
                "frameName" => $fs->name,
                "imageLayout" => url('/uploads/frames/'.$fs->image_layout),
                "imageBackground" => url('/uploads/frames/'.$fs->image_background),
                "imageForeground" => url('/uploads/frames/'.$fs->image_foreground),
                "imagePreview" => url('/uploads/frames/'.$fs->image_preview),
                "frameDescription"=>$fs->description,
            ];
        }
        return $this->response->array($jsonArray);
    }

    public function categories($apikey)
    {
        $categories= Category::all();
        $jsonArray = [];
        foreach($categories as $category){
            $jsonArray[] = [
                "categoryId"=>$category->id,
                "categoryName"=>$category->name,
                "categoryDescription"=>$category->description,

            ];
        }
        return $this->response->array($jsonArray);
    }
}
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

    public function getAPIKey($imei)
    {
        $getAPI = ApiKey::where('imei',$imei);
        if($getAPI->count()>0){
            $api = $getAPI->first();
            if($api->subscribed())
            {
                if($api->billingIsActive())
                {
                    $jsonArray = [
                        "status" => true,
                        "api" =>$api->api ,
                        "message" => ""
                    ];
                }else{
                    $jsonArray = [
                        "status" => false,
                        "message" => "The client billing is not activated."
                    ];
                }

            }else{
                $jsonArray = [
                    "status" => false,
                    "message" => "API Key not subscribed to any plan."
                ];
            }

        }else{
            $jsonArray = [
                "status" => false,
                "message" => "Client not registered."
            ];
        }
        return $this->response->array($jsonArray) ;
    }
    public function check($imei,$apikey)
    {
        $apiCheck = ApiKey::where('api',$apikey)
            ->where('imei',$imei);
        if($apiCheck->count()>0){
            $api = $apiCheck->first();
            if($api->subscribed())
            {
                if($api->billingIsActive())
                {
                    $jsonArray = [
                        "api" => true,
                        "message" => ""
                    ];
                }else{
                    $jsonArray = [
                        "api" => false,
                        "message" => "The client billing is not activated."
                    ];
                }

            }else{
                $jsonArray = [
                    "api" => false,
                    "message" => "API Key not subscribed to any plan."
                ];
            }

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
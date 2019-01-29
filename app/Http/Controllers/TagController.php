<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function get(){       
        $client = new \GuzzleHttp\Client();        
        
        try {
            $request = $client->get('https://api.flickr.com/services/rest/?method=flickr.tags.getHotList&api_key=379a0a423ae8497dff54df125c6b0b50&format=json&period=week');
            $response = $request->getBody()->getContents();            
            $response = json_decode(trim($response, "jsonFlickrApi()"));
            $data = array('data'=> $response->hottags->tag);
            return json_encode($data);
        }catch (RequestException $e){
            file_put_contents(storage_path().'/logs.txt',var_export($e->getMessage(),1)."\n",FILE_APPEND);
        }
        
    }
}
#
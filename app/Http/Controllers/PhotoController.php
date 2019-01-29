<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function get(){       
        $client = new \GuzzleHttp\Client();        
        
        try {
            $request = $client->get('https://api.flickr.com/services/feeds/photos_public.gne?format=json');
            $response = $request->getBody()->getContents();            
            $response = json_decode(trim($response, "jsonFlickrFeed()"));
            $data = array('data'=> $response->items);
            return json_encode($data);
        }catch (RequestException $e){
            file_put_contents(storage_path().'/logs.txt',var_export($e->getMessage(),1)."\n",FILE_APPEND);
        }
        
    }
}
#
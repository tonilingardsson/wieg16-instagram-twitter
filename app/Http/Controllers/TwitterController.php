<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function showAll() {
        $tweets = Tweet::all();
        return View('twitter/index', ['tweets' => $tweets]);
    }
    public function count() {
        $tweets = Tweet::all();
        $result = Tweet::countWords($tweets);
        return response()->json($result);
    }
    public function exclude() {
        $tweets = Tweet::all();
        $result = Tweet::excludeWords($tweets);
        return response()->json($result);
    }
    public function tweetForm() {
        $searchWord = "";
        $tweets = [];
        if (isset($_GET['search'])) {
            $searchWord = $_GET['search'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=".$searchWord,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer AAAAAAAAAAAAAAAAAAAAAD%2Bs3QAAAAAA%2B3ZX40HICY%2Bf4flR0i3VXxLYvv0%3DEC9W3fF3XgjnhpdVpMnh2etKqedBDFeTFl2xTpsuibsgezgv7c",
                    "cache-control: no-cache",
                    "postman-token: 18deg459-61f2-adac-2e35-165c1cgg8282"
                ),
            ));
            $response = json_decode(curl_exec($curl),true);
            curl_close($curl);
            $tweets = Tweet::findTweet($response);
        }
        return View('twitter/count', ['tweets' => $tweets]);
    }
}
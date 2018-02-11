<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;

class ImportTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tweets';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing tweets';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Initializing curl ...');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=housemusic",
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
        foreach ($response['statuses'] as $tweet) {
            $tweets = Tweet::findOrNew($tweet['id']);
            $this->info("Importing tweets: ".$tweet['id']);
            $tweets->fill($tweet)->save();
        }
        $this->info("Tweets imported");
    }

}

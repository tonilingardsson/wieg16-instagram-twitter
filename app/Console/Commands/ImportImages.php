<?php

namespace App\Console\Commands;

use App\Image;
use App\User;
use Illuminate\Console\Command;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing images from Instagram!';

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
        $this->info("Initializing curl...");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.instagram.com/v1/users/self/media/recent?access_token=5594148073.62da917.5c16bbf5c87d468fbd77b4eef7d544d4",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: b7723f08-457c-7bb9-efca-4884a0c1cce4"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);

        foreach ($response['data'] as $posts) {

            $caption = Image::findOrNew($posts['caption']['id']);
            $this->info("Importing caption/images: " .$posts['caption']['id']);
            $caption->fill($posts['caption']);
            foreach ($posts['images'] as $image) {
                $caption->fill($image);
                $caption->save();
            }
        }
    }
}

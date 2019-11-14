<?php

use App\Album;
use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Album::create([
            'title' => 'Test Album Uno',
            'blurb' => "this is a test blurb haha",
            'price' => 400,
            'previewURL' =>'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'fullpurchaseURL' => 'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'coverartURL' => 'https://f4.bcbits.com/img/a3735313250_2.jpg',
            'catalogID' =>'0001'
        ]);

        Album::create([
            'title' => 'Test Album 2',
            'blurb' => "chill album",
            'price' => 300,
            'previewURL' =>'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'fullpurchaseURL' => 'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'coverartURL' => 'https://f4.bcbits.com/img/a3735313250_2.jpg',
            'catalogID' =>'0002'
        ]);

        Album::create([
            'title' => 'Test Album 3333',
            'blurb' => "this is a test blurb haha",
            'price' => 500,
            'previewURL' =>'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'fullpurchaseURL' => 'https://storage.cloud.google.com/albums_example/albums/Playlab%20-%20Playlab%20Volume%202%20-%2002%20slammer.mp3',
            'coverartURL' => 'https://f4.bcbits.com/img/a3735313250_2.jpg',
            'catalogID' =>'0003'
        ]);
    }
}

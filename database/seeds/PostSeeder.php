<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::table('post_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $author = User::where('id', '1')->first();


        $post = Post::create([
            'title' => 'Post titel',
            'text' => 'body post',
        ]);


        $post->users()->attach($author);

    }
}

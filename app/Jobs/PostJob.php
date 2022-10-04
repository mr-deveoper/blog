<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use GuzzleHttp\Client;

class PostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = User::firstOrCreate(['email' => 'admin@blog.com', 'name' => 'admin']);

        $client = new Client();

        $request = $client->get('https://candidate-test.sq1.io/api.php');

        // Get the actual response without headers
        $posts = json_decode($request->getBody(), true);

        if ($posts && isset($posts['articles'])) {
            foreach ($posts['articles'] ?? [] as $post) {
                $admin->posts()->updateOrCreate(['title' => $post['title']], $post);
            }
        }
    }
}

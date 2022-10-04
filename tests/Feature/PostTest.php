<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanViewAllPostsOnHomePage()
    {
        $posts = Post::factory()
            ->for(User::factory())
            ->count(10)
            ->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        $posts->each(function ($post) use ($response) {
            $response->assertSeeText($post->title);
        });
    }

    public function testUserWillSeeNotFoundPosts()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200)->assertSeeText('No Posts found');
    }

    public function testLoggedUserCanCreatePostWithCorrectData()
    {
        $this->actingAs(User::factory()->create())
            ->post(
                route('posts.store'),
                $attributes = [
                    'title' => 'This is a Title',
                    'description' => 'This is a Description',
                    'publication_date' => date('Y-m-d H:i:s'),
                ],
            )
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', $attributes);
    }

    public function testGuestUserCanNotCreatePost()
    {
        $this->post(
            route('posts.store'),
            $attributes = [
                'title' => 'This is a Title',
                'description' => 'This is a Description',
                'publication_date' => date('Y-m-d H:i:s'),
            ],
        )
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $posts = Post::all();

        $this->assertCount(0, $posts);
    }

    public function testUserCannotCreatePostWithoutTitle()
    {
        $response = $this->actingAs(User::factory()->create())
            ->from(route('posts.create'))
            ->post(
                route('posts.store'),
                $attributes = [
                    'title' => '',
                    'description' => 'This is a Description',
                    'publication_date' => date('Y-m-d H:i:s'),
                ],
            );

        $posts = Post::all();

        $this->assertCount(0, $posts);
        $response->assertRedirect(route('posts.create'));
        $response->assertSessionHasErrors('title');
        $this->assertTrue(session()->hasOldInput('description'));
        $this->assertTrue(session()->hasOldInput('publication_date'));
        $this->assertDatabaseMissing('posts', $attributes);
    }

    public function testUserCannotCreatePostWithoutDescription()
    {
        $response = $this->actingAs(User::factory()->create())
            ->from(route('posts.create'))
            ->post(
                route('posts.store'),
                $attributes = [
                    'title' => 'This is a Title',
                    'description' => '',
                    'publication_date' => date('Y-m-d H:i:s'),
                ],
            );

        $posts = Post::all();

        $this->assertCount(0, $posts);
        $response->assertRedirect(route('posts.create'));
        $response->assertSessionHasErrors('description');
        $this->assertTrue(session()->hasOldInput('title'));
        $this->assertTrue(session()->hasOldInput('publication_date'));
        $this->assertDatabaseMissing('posts', $attributes);
    }

    public function testUserCannotCreatePostWithoutPublicationDate()
    {
        $response = $this->actingAs(User::factory()->create())
            ->from(route('posts.create'))
            ->post(
                route('posts.store'),
                $attributes = [
                    'title' => 'This is a Title',
                    'description' => 'This is a Description',
                    'publication_date' => '',
                ],
            );

        $posts = Post::all();

        $this->assertCount(0, $posts);
        $response->assertRedirect(route('posts.create'));
        $response->assertSessionHasErrors('publication_date');
        $this->assertTrue(session()->hasOldInput('description'));
        $this->assertTrue(session()->hasOldInput('title'));
        $this->assertDatabaseMissing('posts', $attributes);
    }

    public function testGuestUserCanNotViewMyPost()
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testLoggedUserCanViewHisPostsOnlyOnMyPostsPage()
    {
        $user = User::factory()->create();
        $userPosts = Post::factory()
            ->count(5)
            ->create(['user_id' => $user->id]);

        $otherPosts = Post::factory()
            ->count(5)
            ->create();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertSee($userPosts->first()->title)
            ->assertSee($userPosts->last()->title)
            ->assertDontSee($otherPosts->first()->title)
            ->assertDontSee($otherPosts->last()->title);
    }
}

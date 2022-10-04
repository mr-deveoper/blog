<?php

namespace App\Http\Controllers;

use App\Repository\PostRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * HomeController constructor.
     * @param PostRepositoryInterface $postRepository
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth')->except('index');
        $this->postRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->postRepository->getDataWithPagination(request('sort'));

        return view('home', [
            'posts' => $posts,
        ]);
    }
}

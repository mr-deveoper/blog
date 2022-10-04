<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Repository\PostRepositoryInterface;

class PostController extends Controller
{
    /**
    * @var PostRepositoryInterface
    */
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     *
     * @return void
     */

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth')->except('show');
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getDataWithPagination(request('sort'),auth()->user()->id);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
        return view('posts.show',['post' => $post]);
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();

        $this->postRepository->create($data);

        return redirect(route('posts.index'))->with('success', __('Post created Successfully'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Domain\Services\PostService;
use App\Http\FormRequests\PostFormRequest;
use Illuminate\Support\Facades;
use Symfony\Component\HttpFoundation;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $this->response['data'] = $this->postService->findAll();

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function show($id)
    {
        $this->response['data'] = $this->postService->findOneBy('_id', $id);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function store(PostFormRequest $request)
    {
        $attributes = $request->get('post_form');

        $this->response['data'] = $this->postService->create($attributes);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function update(PostFormRequest $request, $id)
    {
        $attributes = $request->get('post_form');

        $this->response['data'] = $this->postService->update($id, $attributes);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->response['data'] = $this->postService->delete($id);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }
}

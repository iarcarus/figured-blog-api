<?php

namespace App\Http\Controllers;

use App\Domain\Services\UserService;
use App\Http\FormRequests\UserFormRequest;
use Illuminate\Support\Facades;
use Symfony\Component\HttpFoundation;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $this->response['data'] = $this->userService->findAll();

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function show($id)
    {
        $this->response['data'] = $this->userService->findOneBy('id', $id);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function store(UserFormRequest $request)
    {
        $attributes = $request->get('user_form');

        $this->response['data'] = $this->userService->create($attributes);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function update(UserFormRequest $request, $id)
    {
        $attributes = $request->get('user_form');

        $this->response['data'] = $this->userService->update($id, $attributes);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->response['data'] = $this->userService->delete($id);

        return Facades\Response::json($this->response, HttpFoundation\Response::HTTP_OK);
    }
}

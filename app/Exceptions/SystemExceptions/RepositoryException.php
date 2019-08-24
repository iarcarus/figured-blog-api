<?php

namespace App\Exceptions\SystemExceptions;

use Illuminate\Http\Response;

class RepositoryException extends SystemExceptions
{
    public function getShortMessage()
    {
        return 'RepositoryException';
    }

    public function getDescription()
    {
        return "Class {$this->params['model']} must be an instance of Illuminate\\Database\\Eloquent\\Model";
    }

    public function getHttpStatus()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}

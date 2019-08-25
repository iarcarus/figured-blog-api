<?php

namespace App\Exceptions\BusinessExceptions;

use Illuminate\Http\Response;

class PostNotFoundException extends BusinessRuleExceptions
{
    public function getShortMessage()
    {
        return 'PostNotFound';
    }

    public function getDescription()
    {
        return trans('exception.post.not_found');
    }

    public function getHttpStatus()
    {
        return Response::HTTP_NOT_FOUND;
    }
}

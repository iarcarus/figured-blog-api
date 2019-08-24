<?php

namespace App\Exceptions\BusinessExceptions;

use Illuminate\Http\Response;

class UserNotFoundException extends BusinessRuleExceptions
{
    public function getShortMessage()
    {
        return 'UserNotFound';
    }

    public function getDescription()
    {
        return trans('exception.user.not_found');
    }

    public function getHttpStatus()
    {
        return Response::HTTP_NOT_FOUND;
    }
}

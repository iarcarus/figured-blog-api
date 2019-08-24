<?php

namespace App\Exceptions\BusinessExceptions;

use Illuminate\Http\Response;

class UserCannotDeleteItselfException extends BusinessRuleExceptions
{
    public function getShortMessage()
    {
        return 'UserCannotDeleteItself';
    }

    public function getDescription()
    {
        return trans('exception.user.cannot_delete_itself');
    }

    public function getHttpStatus()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}

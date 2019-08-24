<?php

namespace App\Exceptions\SystemExceptions;

use Illuminate\Http\Response;

class ServiceException extends SystemExceptions
{
    public function getShortMessage()
    {
        return 'ServiceInvalidException';
    }

    public function getDescription()
    {
        return trans('exception.general.service_invalid');
    }

    public function getHttpStatus()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}

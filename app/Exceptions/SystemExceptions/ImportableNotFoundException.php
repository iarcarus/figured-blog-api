<?php

namespace App\Exceptions\SystemExceptions;

use Illuminate\Http\Response;

class ImportableNotFoundException extends SystemExceptions
{
    public function getShortMessage()
    {
        return 'ImportableNotFound';
    }

    public function getDescription()
    {
        return trans('exception.importable.not_found', ['type' => $this->params['type'] ?? '']);
    }

    public function getHttpStatus()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}

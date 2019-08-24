<?php

namespace App\Exceptions;

abstract class CustomRuleExceptions extends \Exception
{
    protected $description;
    protected $message;
    protected $help;
    protected $httpCode;
    protected $params;

    public function render()
    {
        return response(['error' => $this->getError()], $this->getHttpStatus());
    }

    public function getError()
    {
        return [
            'shortMessage' => $this->getShortMessage(),
            'message'      => $this->getDescription(),
            'help'         => $this->getHelp(),
        ];
    }

    abstract public function getShortMessage();

    abstract public function getDescription();

    public function getHelp()
    {
        return $this->help ?? '';
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    abstract public function getHttpStatus();
}

<?php

namespace Crm\Validators\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

class ValidationException extends Exception
{
    public function __construct(
        protected MessageBag $errors
    )
    {
        parent::__construct($errors->first());
    }

    public function getErrors(): MessageBag
    {
        return $this->errors;
    }

    public static function withMessages(array $messages): self
    {
        return new self(new MessageBag($messages));
    }
}

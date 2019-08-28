<?php

namespace Fotostrana\Exception;

use Throwable;

class EOFException extends \OutOfBoundsException
{
    public function __construct($message = "You have reached the end of the file", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

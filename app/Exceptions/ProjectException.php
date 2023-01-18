<?php

namespace App\Exceptions;

use Exception;

class ProjectException extends Exception
{
    public function render()
    {
        return response()->json(['error' => $this->getMessage()], $this->getCode());
    }
}

<?php

namespace App\Exceptions;

use Exception;

class AuthExeption extends Exception
{
    public function render()
    {
        return response()->json(['error' => $this->getMessage()], 401);
    }
}

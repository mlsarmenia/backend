<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'code'    => $this->code,
            'message' => $this->message,
        ], $this->code);
    }
}

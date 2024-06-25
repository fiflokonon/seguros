<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generateUniqueRef($length)
    {
        $bytes = random_bytes($length);
        return strtoupper(bin2hex($bytes));
    }

    public function generateUniqueCode()
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (Invoice::where('code', $code)->exists());
        return $code;
    }
}

<?php

namespace App\Http;

use App\Http\Middleware\Admin;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'admin' => Admin::class,
    ];
}

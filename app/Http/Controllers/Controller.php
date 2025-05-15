<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller extends BaseController
{
    use AuthorizesRequests;

    /**
     * The number of items to display per page.
     *
     * @var int
     */
    public int $perPage = 10;
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cru;

class CruApiController extends Controller
{
    function cru (){
        return Cru::all();

    }
}



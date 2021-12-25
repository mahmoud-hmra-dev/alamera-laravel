<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;

class DepotApiController extends Controller
{
    function depot (){
        return Depot::all();

    }
}



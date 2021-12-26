<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratory;

class LaboratoryApiController extends Controller
{
    function Laboratory (){
        return Laboratory::all();

    }
}



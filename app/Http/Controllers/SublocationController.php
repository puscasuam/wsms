<?php

namespace App\Http\Controllers;

use App\Location;
use App\Sublocation;
use Illuminate\Http\Request;

class SublocationController extends Controller
{
public function addSublocation()
{
    $sublocation = new Sublocation();
    $sublocation->location_id = 1;
    $sublocation->name = "Sublocation1";
    $sublocation->capacity = 10;
    $sublocation->save();
    return "Sublocation saved";
}
}

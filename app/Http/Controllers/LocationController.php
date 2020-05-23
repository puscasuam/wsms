<?php

namespace App\Http\Controllers;

use App\Gemstone;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function addLocation()
    {
        $location = new Location();
        $location->name = "Location1";
        $location->capacity = 10;
        $location->save();
        return "Location saved";
    }
}

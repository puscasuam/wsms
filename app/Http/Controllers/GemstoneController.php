<?php

namespace App\Http\Controllers;

use App\Gemstone;
use Illuminate\Http\Request;

class GemstoneController extends Controller
{
    public function addGemstone()
    {
        $gemstone = new Gemstone();
        $gemstone->name = "Gemstone1";
        $gemstone->save();
        return "Gemstone saved";
    }
}

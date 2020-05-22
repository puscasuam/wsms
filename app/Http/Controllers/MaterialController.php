<?php

namespace App\Http\Controllers;

use App\Category;
use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function addMaterial()
    {
        $material = new Material();
        $material->name = "Material1";
        $material->save();
        return "Material saved";
    }
}

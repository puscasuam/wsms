<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function addBrand()
    {
        $brand = new Brand();
        $brand->name = "Brand1";
        $brand->save();
        return "Brand saved";
    }
}

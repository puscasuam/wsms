<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        $category = new Category();
        $category->name = "Category1";
        $category->save();
        return "Category saved";
    }
}

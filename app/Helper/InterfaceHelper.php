<?php

namespace App\Helper;

use Illuminate\Http\Request;

interface InterfaceHelper
{
    public function form();

    public function get(int $id);

    public function view(int $id);

    public function all(Request $request);

    public function post(Request $request);

    public function put(Request $request);

    public function delete(int $id);
}

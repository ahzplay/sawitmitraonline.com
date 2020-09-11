<?php


namespace App\Http\Controllers;


use http\Client\Request;

Interface CrudInterface
{
    public function add(Request $request);
}

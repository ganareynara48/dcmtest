<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class sheetsController extends Controller
{
    public function get()
    {
        $sheetdb = new SheetDB('ihvk52x31fdn3');

        dd($response = $sheetdb->get());
    }
}

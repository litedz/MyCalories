<?php

namespace App\Http\Controllers;

use App\Charts\SimpleChar;

class StaticUserController extends Controller
{
    public $chart;

    public function __construct()
    {

    }

    public function StaticUser(SimpleChar $chart)
    {

        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $chart->height(500);
        $chart->width(500);

        return view('layouts.static-user', compact('chart'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {

        $labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei'];
        $data = [10, 25, 15, 30, 20];

        return view('welcome', compact('labels', 'data'));
    }
}

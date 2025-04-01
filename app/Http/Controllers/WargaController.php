<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        return view('dashboard.warga'); // Pastikan view ini ada
    }
}

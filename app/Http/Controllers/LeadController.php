<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
      //traemos todos los lead,del más reciente al más antiguo  
      $leads = Lead::orderBy('created_at','desc')->get();

    return view('admin.leads', compact('leads'));
    }
}

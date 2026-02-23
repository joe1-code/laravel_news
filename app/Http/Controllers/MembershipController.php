<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(){

    return view('membership.index');
    }

    public function getMembers(){
        return true;
    }

    public function postMembers(){
        return true;
    }
}

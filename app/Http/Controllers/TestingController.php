<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        // $att = attendance::with("attendances")->get();
        // $user = User::where('role_id', '!=', 1)->with(["classes.attendances", "assignments.submitAssignment.grade"])
        //     ->get();
        // // $att = attendance::with(["users", "class"])->get();
        // return $user;

        // return view("welcome", compact('att'));
    }
}

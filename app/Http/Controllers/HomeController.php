<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $salutation = "<b>{$this->getGreetings()},</b> {$user->first_name} {$user->last_name}";
        return view('dashboard', [
            'salutation' => $salutation
        ]);
    }

    public function getGreetings(): string
    {
        $time = Carbon::now()->hour;
        if ($time < "12") {
            return "Good morning";
        }
        if ($time >= "12" && $time < "17") {
            return "Good afternoon";
        }
        if ($time >= "17" && $time < "19") {
            return "Good evening";
        }
        if ($time >= "19") {
            return "Good night";
        }
        return "Hello";
    }
}

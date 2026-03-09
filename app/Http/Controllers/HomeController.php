<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\Summit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all = Summit::orderBy('created_at', 'DESC')->count();
        $registers = Summit::orderBy('created_at', 'DESC')->get();
        $attandance = Summit::where('attendance', 1)->count();

        $allPets = Summit::pluck('pets')->flatten()->count();
        $pet_types = $registers->pluck('pets')->flatten()->unique()->toArray();

        $implode = implode(', ', $pet_types);

        $dogCount = Summit::whereJsonContains('pets', 'dog')->count();
        $catCount = Summit::whereJsonContains('pets', 'cat')->count();
        $bothCount = Summit::whereJsonContains('pets', 'dogcat')->count();
        $otherCount = Summit::whereNotIn('pets', ['dog', 'cat', 'dogcat'])->count();

        $percent_dog = $allPets != 0 ? (($dogCount) / $allPets) * 100 : 0;
        $percent_cat = $allPets != 0 ? (($catCount) / $allPets) * 100 : 0;
        $percent_both = $allPets != 0 ? (($bothCount) / $allPets) * 100 : 0;
        $percent_other = $allPets != 0 ? (($otherCount) / $allPets) * 100 : 0;



        return view('home')->with([
            'all' => $all,
            'attendance' => $attandance,
            'registers' => $registers,
            'percent_dog' => $percent_dog,
            'percent_cat' => $percent_cat,
            'percent_both' => $percent_both,
            'percent_other' => $percent_other,
            'allPets' => $allPets,
            'pet_types' => $pet_types,
        ]);
    }

    
}

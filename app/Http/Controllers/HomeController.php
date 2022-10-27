<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

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
        $games = Game::get();
        $questions = Question::get();
        $options = Option::get();
        return view('home', compact('games', 'questions', 'options'));
    }
}

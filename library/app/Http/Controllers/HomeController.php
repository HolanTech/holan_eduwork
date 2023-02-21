<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Member;
use App\Models\User;
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
        //$members = Member::with('user')->get();
        // $books = Book::with('publisher')->get();
        //$publishers = Publisher::with('books')->get();
        $books = Book::with('catalog')->get();
        return $books;
        return view('home');
    }
}

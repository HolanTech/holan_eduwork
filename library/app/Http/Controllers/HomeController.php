<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Catalog;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
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
        // $books = Book::with('catalog')->get();

        //return view('home');

        $data1 = Member::select('*')
            ->join('users', 'users.member_id', '=', 'members.id')
            ->get();

        $data2 = Member::select('*')
            ->leftJoin('users', 'users.member_id', '=', 'members.id')
            ->where('users.id', NULL)
            ->get();

        $data3 = Transaction::select('members.id', 'members.name')
            ->rightJoin('members', 'members.id', '=', 'transactions.member_id')
            ->where('transactions.member_id', NULL)
            ->get();

        $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
            ->join('transactions', 'transactions.member_id', '=', 'members.id')
            ->orderBy('members.id', 'asc')
            ->get();

        $data5 = Transaction::select('members.id', 'members.name', 'members.phone_number')
            ->join('members', 'transactions.id', '=', 'members.id')
            ->orderBy('members.name', 'asc', 'havingcount', 'members.name', '>', 1, 'asc')
            ->get();

        $data6 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
            ->rightJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->orderBy('members.id', 'asc')
            ->get();

        $data7 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('transactions', 'members.id', 'transactions.member_id')
            ->where('transactions.date_end', 'like', '2021-05%')
            ->get();

        $data8 = Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->where('transactions.date_end', 'like', '2021-05&')
            ->get();

        $data9 = Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->where('transactions.date_end', 'like', '2021-06%')
            ->Where('transactions.date_start', 'like', '2021-06%')
            ->get();

        $data10 = Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->where('members.address', 'like', '%Bandung%')
            ->Where('transactions.date_start', '!=', NULL)
            ->get();

        $data11 = Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end')
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->where('members.address', 'like', '%Bandung%')
            ->Where('members.gender', '=', 'M')
            ->Where('transactions.date_start', '!=', NULL)
            ->get();

        $data12 =  Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'books.qty')
            ->join('transactions', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->where('transaction_details.qty', '>', 1)
            ->get();


        $data14 =  Member::select('members.name', 'members.address', 'members.phone_number', 'transactions.date_start', 'transactions.date_end', 'books.qty', 'books.isbn', 'books.title', 'publishers.name', 'authors.name', 'catalogs.name')
            ->join('transactions', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('books', 'transaction_details.book_id', '=', 'books.id')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('catalogs', 'books.catalog_id', '=', 'catalogs.id')
            ->get();


        $data15 = Catalog::select('books.title', 'catalogs.id', 'catalogs.name')
            ->leftjoin('books', 'books.catalog_id', '=', 'catalogs.id')
            ->get();


        $data16 = Book::select('books.isbn', 'books.title', 'books.year', 'books.publisher_id', 'books.author_id', 'books.catalog_id', 'books.qty', 'books.price', 'publishers.name')
            ->leftJoin('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->orderBy('books.title')
            ->get();
        $data17 = Author::select('*')
            ->join('books', 'books.author_id', '=', 'authors.id')
            ->where('author_id', '=', '1')
            ->count();


        $data18 = Book::select('*')
            ->where('books.price', '>', 10_000)
            ->get();



        $data19 = Book::select('*')
            ->where('books.publisher_id', '=', '1')
            ->Where('books.qty', '>', 3)
            ->get();

        $data20 = Member::select('*')
            ->whereMonth('created_at', '06')
            ->get();


        //return $data1;
        return view('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        //$member = Member::with('user')->get();
        if (auth()->user()->can('edit page')) {
            $books = Book::count();
            $members = Member::count();
            $publishers = Publisher::count();
            $transactions = Transaction::count();
            $authors = Author::count();

            $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
            $label_donut = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');

            $data_pie =  Book::select(DB::raw("COUNT(author_id) as total"))->groupBy('author_id')->orderBy('author_id', 'asc')->pluck('total');
            $label_pie = Author::orderBy('authors.id', 'asc')->join('books', 'books.author_id', '=', 'authors.id')->groupBy('name')->pluck('name');

            $label_bar = ['Transaction', 'Return'];
            $data_bar = [];

            foreach ($label_bar as $key => $value) {
                $data_bar[$key]['label'] = $label_bar[$key];
                $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210, 214, 222, 1)';
                $data_month = [];

                foreach (range(1, 12) as $month) {
                    if ($key == 0) {
                        $data_month[] = Transaction::select(DB::raw('COUNT(*) as total'))->whereMonth('date_start', $month)->first()->total;
                    } else {
                        $data_month[] = Transaction::select(DB::raw('COUNT(*) as total'))->whereMonth('date_end', $month)->first()->total;
                    }
                }

                $data_bar[$key]['data'] = $data_month;
            }


            return view('home', compact('books', 'members', 'publishers', 'transactions', 'authors', 'data_donut', 'label_donut', 'data_pie', 'label_pie', 'data_bar'));
        } else {
            abort('403');
        }
    }

    public function spatie()
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'edit page']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);


        // $user = auth()->user();
        // $user->assignRole('admin');
        // $user = User::with('roles')->get();
        // return $user;
    }
}

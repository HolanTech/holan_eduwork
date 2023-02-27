<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->can('edit page')) {
            return view('admin.publisher');
        } else {
            abort('403');
        }
    }

    public function api()
    {
        $publishers = Publisher::all();
        $datatables = datatables()->of($publishers)
            ->addColumn('date', function ($publisher) {
                return convert_date($publisher->created_at);
            })->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name', 'email', 'phone_number', 'address' => ['required']
        ]);
        // $publisher = new publisher;
        // $publisher->name = $request->name;
        // $publisher->save();
        Publisher::create($request->all());
        return redirect('publishers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request, [
            'name', 'email', 'phone_number', 'address' => ['required']
        ]);

        $publisher->update($request->all());
        return redirect('publishers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect('publishers');
    }
}

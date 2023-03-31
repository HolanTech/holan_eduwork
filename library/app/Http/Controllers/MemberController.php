<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->can('edit page')) {
            return view('admin.member');
        } else {
            abort('403');
        }
    }
    public function api(Request $request)
    {
        if ($request->gender) {
            $datas = Member::where('gender', $request->gender)->get();
        } else {
            $datas = Member::all();
        }
        $datatables = datatables()->of($datas)
            ->addColumn('date', function ($datas) {
                return convert_date($datas->created_at);
            })->addIndexColumn();

        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required']
        ]);

        Member::create($request->all());

        return redirect('members');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required', 'max:255']
        ]);

        $member->update($request->all());

        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
    }
}

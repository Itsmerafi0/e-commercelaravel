<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = User::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <a href="'. route('dashboard.user.edit', $item->id). '" class="bg-gray-500 text-white rounded-md px-2 py-1 m-4 ">
                EDIT
                </a>
                <form class ="inline-block" action="'. route('dashboard.user.destroy', $item->id) .'" method="POST">
                    <button class="bg-red-500 text-white rounded-md px-2 py-1 m-4 "> 
                    HAPUS
                    </button>
                '. method_field('delete') . csrf_field() .'

                </form>
                ';
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.dashboard.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.dashboard.user.edit',[
            'item' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        $user->update($data);

        return redirect()->route('dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.user.index');    }
}

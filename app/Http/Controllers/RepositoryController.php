<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate(['url' => 'required|url', 'description' => 'required']);
        $request->user()->repositories()->create($request->all());
        return redirect()->route('repositories.index');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        $request->validate(['url' => 'required|url', 'description' => 'required']);

        if($request->user()->id != $repository->user_id) {
            abort(403);
        }

        $repository->update($request->all());

        return redirect()->route('repositories.edit', $repository);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Repository  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        $repository->delete();

        return redirect()->route('repositories.index');
    }
}

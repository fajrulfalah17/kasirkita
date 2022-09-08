<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::when(request()->q, function($types) {
            $types = $types->where('name', 'like', '%'. request()->q. '%');
        })->latest()->paginate(5);

        return Inertia::render('Apps/Types/Index', [
            'types'     => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Apps/Types/Create');
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
            'name'      => 'required|uniques:types',
            'description'   => 'required'
        ]);

        Type::create([
            'name'          => $request->name,
            'description'   => $request->description
        ]);

        return redirect()->route('apps.types.index');
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
    public function edit(Type $type)
    {
        return Inertia::render('Apps/Types/Edit', [
            'type'      => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $this->validate($request, [
            'name'      => 'required|uniques:types',
            'description'   => 'required'
        ]);

        $type->update([
            'name'          => $request->name,
            'description'   => $request->description
        ]);

        return redirect()->route('apps.types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);

        $type->delete();

        return redirect()->route('apps.types.index');
    }
}

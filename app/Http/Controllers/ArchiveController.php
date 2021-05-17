<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $archives = Archive::all();

        return view('archives.index', compact('archives'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archives.create');

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
            'name' => 'required|unique:archives'
        ]);

        $archive = Archive::create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name)

        ]);
        return redirect()->route('home')->with('status', 'Новый шкаф ' . $request->name . ' создан');
    }

    /**
     * Display the specified resource.
     *
     * @param Archive $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        $archive = Archive::find($archive->id);
        $cells = $archive->cells()->get()->all();
        return view('archives.show', compact('archive', 'cells'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Archive $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        return view('archives.edit', compact('archive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Archive $archive
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Archive $archive)
    {
        $this->validate($request, [
            'name' => 'required|unique:archives,name,' . $archive->id
        ]);

        $archive->update([
            'name'=>$request['name']
        ]);

        return redirect()->route('home', $archive)->with('status', 'Архив-шкаф ' . $archive->name . ' обновлен.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Archive $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        $archive->delete();
        return redirect()->route('home')->with('status', 'Архив ' . $archive->name . ' удален');
    }
}

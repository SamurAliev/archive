<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FolderController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $cell = Cell::find($request->get('cell_id'));
        return view('folders.create', compact('cell'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cellId = $request->get('cell_id');
        $cell = Cell::find($cellId);

        $this->validate($request, [
            'name' => 'required|unique:folders'
        ]);

        $cell->folders()->create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name)
        ]);
        return redirect()->route('cells.show', $cell)->with('status', 'Новая папка ' . $request->name . ' создана');
    }

    /**
     * Display the specified resource.
     *
     * @param Folder $folder
     * @return void
     */
    public function show(Folder $folder)
    {
        $files = $folder->files()->get()->all();

        return view('folders.show', compact('files', 'folder'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        return view('folders.edit', compact('folder'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Folder $folder
     * @return void
     */
    public function update(Request $request, Folder $folder)
    {
        $cell = $folder->cell()->first();

        $this->validate($request, [
            'name' => 'required|unique:cells,name,' . $folder->id
        ]);

        $folder->update([
            'name'=>$request['name']
        ]);


        return redirect()->route('cells.show', $cell)->with('status', 'Папка ' . $folder->name . ' обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {

        $folder->delete();
        $cell = $folder->cell()->first();
        return redirect()->route('cells.show', $cell)->with('status', 'Папка ' . $folder->name . ' удалена');
    }
}

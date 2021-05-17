<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $archive = Archive::find($request->get('archive_id'));
        return view('cells.create', compact('archive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Archive $archive
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $archiveId = $request->get('archive_id');
        $archive = Archive::find($archiveId);
        $this->validate($request, [
            'name' => 'required|unique:cells'
        ]);

        $cell = $archive->cells()->create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name)
        ]);
        return redirect()->route('archives.show', $archive)->with('status', 'Новая ячейка ' . $request->name . ' создана');
    }

    /**
     * Display the specified resource.
     *
     * @param Cell $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell)
    {
        $archive = $cell->archive()->get()->first();
        $folders = $cell->folders()->get()->all();
        return view('cells.show', compact('folders', 'cell', 'archive'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cell $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(Cell $cell)
    {
        return view('cells.edit', compact('cell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Cell $cell
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Cell $cell)
    {
        $archive = $cell->archive()->first();
        $this->validate($request, [
            'name' => 'required|unique:cells,name,' . $cell->id
        ]);

        $cell->update([
            'name'=>$request['name']
        ]);


        return redirect()->route('archives.show', $archive)->with('status', 'Ячейка ' . $cell->name . ' обновлена.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Archive $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        $cell->delete();
        $archive = $cell->archive()->get()->first();
        return redirect()->route('archives.show', $archive)->with('status', 'Ячейка ' . $cell->name . ' удалена');
    }
}

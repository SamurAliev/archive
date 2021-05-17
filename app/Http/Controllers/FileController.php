<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
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
        $folder = Folder::find($request->get('folder_id'));
        return view('files.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $folderId = $request->get('folder_id');
        $folder = Folder::find($folderId);

        $this->validate($request, [
            'name' => 'required|unique:files',
            'content' => 'required'
        ]);

        $folder->files()->create([
            'name' => $name = $request->name,
            'content' => $request['content'],
            'slug' => Str::slug($name)
        ]);
        return redirect()->route('folders.show', $folder)->with('status', 'Новый файл ' . $request->name . ' создан');
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return void
     */
    public function show(File $file)
    {
        return view('files.show', compact('file'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $file
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param File $file
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, File $file)
    {
        $folder = $file->folder()->first();

        $this->validate($request, [
            'name' => 'required|unique:files,name,' . $file->id,
            'content' => 'required'

        ]);

        $file->update([
            'name'=> $name = $request['name'],
            'content' => $request['content'],
            'slug' => Str::slug($name)
        ]);


        return redirect()->route('folders.show', $folder)->with('status', 'Файл ' . $file->name . ' обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();
        $folder = $file->folder()->first();
        return redirect()->route('folders.show', $folder)->with('status', 'Файл ' . $file->name . ' удален');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\sectionValidation;
use App\sections;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = sections::all();
        return view('sections.section', compact('sections'));
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
    public function store(sectionValidation $request)
    {

        //         $input = $request->all();
        //         $existeSection = sections::where('section_name', '=', $input['section_name'])->exists();

        //         if ($existeSection) {
        //             session()->flash('Error', 'Error : Nom de section déja existe');
        //             return redirect('/sections');
        //         } else {
        // session()->flash('Add', 'Section ajouter avec succés');
        //             return redirect('/sections');
        //         }

        $validated = $request->validated();
        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name),
        ]);
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, sections $sections)
    {
        // $validated = $request->validated();

        $request->validate(
            [
                'section_name' => 'required|max:255|unique:sections,section_name,' . $request->id,
                'description' => 'required',
            ],
            [
                'section_name.unique' => "Nom deja pris",
            ]
        );

        $input = $request->all();

        $section = sections::find($input['id']);

        // $section->section_name = $input['section_name'];
        // $section->description = $input['description'];
        // $section->save();
        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);
        session()->flash('edit', 'Modifier avec succés');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        sections::find($request->id)->delete();
        // $section->delete();
        session()->flash('delete', 'Supprimer avec succes');
        return redirect('/sections');
    }
}

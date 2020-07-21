<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $widgets = Widget::orderBy('id', 'ASC')->paginate(3);

        return view('admin.widgets.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.widgets.create');
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
        $widget = Widget::create($request->all());

        return redirect()->route('widgets.edit', $widget->id)->with('info','Widget creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $widget = Widget::find($id);

        return view('admin.widgets.show', compact('widget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $widget = Widget::find($id);

        return view('admin.widgets.edit', compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $widget = Widget::find($id);

        $widget->fill($request->all())->save();

        return redirect()->route('widgets.edit', $widget->id)->with('info','Widget modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $widget = Widget::find($id)->delete();

        return back()->with('info', 'Widget borradocon exito');
    }
}

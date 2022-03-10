<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search') && !$request->has('resetsearch') && $request->has('searchbutton') ){ // if search button was pressed and search field is filled
            $departments = Department::where('name','like',"%{$request->search}%")->orderBy('name')->paginate(10);
            $searchValue = $request->search;
        }else{
            $departments = Department::orderBy('name')->paginate(10);
            $searchValue='';
        }

        return view('departments.index',compact('departments', 'searchValue'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        Department::create($request->validated());

        $notifications = array(
            'type'=>'success',
            'title'=>__('Department Management'),
            'message'=>__('Department successfully stored to database.')
        );
        return redirect()->route('departments.index')->with('notifications', array($notifications));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update([
            'name'=> $request->name
        ]);

        $notifications = array(

            'type'=>'success',
            'title'=>__('Demaprtment Management'),
            'message'=>__('Department Data updated.')
        );
        return redirect()->route('departments.index')->with('notifications', array($notifications));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        $notifications = array(
            'type'=>'success',
            'title'=>__('Demaprtment Management'),
            'message'=>__('Department deleted.')
        );
        return redirect()->route('departments.index')->with('notifications', array($notifications));

    }
}

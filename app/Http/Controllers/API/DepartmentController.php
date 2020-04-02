<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Resources\Departments;
use App\Http\Controllers\Controller;
use App\Http\Resources\Department as DepartmentResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Departments(Department::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new DepartmentResource(Department::find($id));
    }
}

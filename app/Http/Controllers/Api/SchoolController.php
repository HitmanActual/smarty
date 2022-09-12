<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\School;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SchoolController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schools = School::all();
        return $this->successResponse($schools,Response::HTTP_OK);
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


        $validateDate = $request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'email',
            'contact_person_name'=>'required',
            'contact_person_email'=>'required',
            'contact_person_phone'=>'required',


        ]);

        $validateDate['subscription'] = Carbon::now();

        $school = School::create($validateDate);
        $types = $request->type_id;
        $school->types()->sync($types);
        return $this->successResponse($school,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\Emploi;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Str;

class EmploiController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user =  JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource by company.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEmploiByIdCompany(){
        $emploi = Emploi::where('company_id',$this->user->company_id)->orderBy('id','desc')->get();
        return response()->json([
            'emploi'  => $emploi,
        ],200);
    }

    /**
     * generate string
     */
    public function generateRandomString($length = 5) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emploi = new Emploi;
        $emploi->title = $request->title;
        $emploi->description = $request->description;
        $emploi->isRemote = $request->isRemote;
        $emploi->location = $request->location;
        $emploi->experience = $request->experience;
        $emploi->numEmp = $request->numEmp;
        $emploi->typeEmploi = $request->typeEmploi;
        $emploi->typeContrat = $request->typeContrat;
        $emploi->slug = $this->generateRandomString().Str::slug($request->title);
        $emploi->company_id = $this->user->company_id;
        $emploi->save();
        return response()->json([
            'message'  => 'emploi added',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Emploi $emploi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emploi $emploi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emploi $emploi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emploi $emploi)
    {
        //
    }
}

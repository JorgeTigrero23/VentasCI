<?php

namespace App\Http\Controllers\Administration;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use PDF;

class CompanyController extends AppBaseController
{
    
    public function index()
    {
        $company = Company::first();

        return view('admin.company.edit')->with('company', $company);

    }

    // public function edit($id)
    // {
    //     $company = Company::first();

    //     return view('admin.company.edit')->with('company', $company);

    // }

    public function update(Request $request, $id)
    {

        //$input = $request->all();
        $company = Company::find($id);

        $company->name = $request->get('name');
        $company->nature = $request->get('nature');
        $company->phone = $request->get('phone');
        $company->country = $request->get('country');
        $company->city = $request->get('city');
        $company->address = $request->get('address');
        
        if($request->hasFile('image'))
        {

            $file = $request->file('image');

            $company->image = uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('img'),  $company->image);

        }
        

        $company->update();

        Flash::success('Datos guardados con exito.');

        return redirect(route('empresa.index')); 
    }
    
}

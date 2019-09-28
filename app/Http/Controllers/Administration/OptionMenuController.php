<?php

namespace App\Http\Controllers\Administration;

use Facades\App\Menu;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\OptionMenuFormRequest;
use App\Models\Option;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;

class OptionMenuController extends AppBaseController
{


    private $iconos=[
        'fa fa-circle-o',
        'fa-th',
        'fa-shopping-cart',
        'fa-folder',
        'fa-plus-square',
        'fa-info-circle',
        'fa-laptop',
        'fa-user',
        'fa-user-md',
        'fa-user-plus',
        'fa-user-secret',
        'fa-user-times',
        'fa-users',
        'fa-adjust',
        'fa-adn',
        'fa-align-center',
        'fa-align-justify',
        'fa-align-left',
        'fa-align-right',
        'fa-angle-left',
        'fa-angle-right',
        'fa-ambulance',
        'fa-anchor',
        'fa-android',
        'fa-angellist',
        'fa-angle-down',
        'fa-angle-double-down',
        'fa-angle-double-left',
        'fa-angle-double-right',
        'fa-angle-double-up',
        'fa-angle-up',
        'fa-calculator',
        'fa-apple',
        'fa-archive',
        'fa-area-chart',
        'fa-asterisk',
        'fa-at',
        'fa-car',
        'fa-mobile',
        'fa-mobile',
        'fa-money',
        'fa-ban',
        'fa-university',
        'fa-bar-chart',
        'fa-bar-chart',
        'fa-barcode',
        'fa-bars',
        'fa-book',
        'fa-bookmark',
        'fa-bookmark-o',
        'fa-file-pdf-o'

    ];

    /**
     * OptionMenuController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ops= Option::orderBy('order')->get();
        $iconos= $this->iconos;

        $menu = Menu::renderAdmin($ops);
        return view("admin.menu.index",compact('ops','iconos','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idPadre){

        $ops=Option::all();
        $iconos=$this->iconos;
        if($idPadre!=0){
            $father= Option::findOrFail($idPadre);
        }else{
            $father=null;
        }

        return view("admin.menu.create",compact('ops','iconos','father'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

//        dd($request->all());
        Option::create([
            "father" => $request->father,
            "name" => $request->name,
            "description" => $request->description,
            "path" => $request->path,
            "icon_r" => $request->icon_r,
            "icon_l" => $request->icon_l
        ]);

        //$input = $request->all()

        Flash::success('Opción creada!')->important();

        return redirect('admin/option');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option= Option::findOrFail($id);

        if ($option->father){
            $father= Option::findOrFail($option->father);
        }
        $icons=$this->iconos;

        return view('admin.menu.edit',compact('option','father','icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionMenuFormRequest $request, $id)
    {

        $op= Option::findOrFail($id);


        $op->father= $request->father=="" ? null : $request->father;
        $op->name=$request->name;
        $op->description=$request->description;
        $op->path=$request->path;
        $op->icon_r=$request->icon_r;
        $op->icon_l=$request->icon_l;
        $op->save();

        Flash::success('Opción actualizada!')->important();

        return redirect('admin/option');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $op= Option::findOrFail($id);

        $op->delete();

        Flash::success('Opción eliminada!')->important();

        return redirect('admin/option');
    }

    public function updateOrden(Request $request){
        $datos= $request->datos ? $request->datos : [];

        $colecion=collect();

        if(count($datos)>0){


            foreach ($datos as $orden => $id){
                $opcion = Option::findOrFail($id);
                $opcion->order= $orden;
                $opcion->save();

                $colecion->push($opcion);
            }

            return response()->json([
                'success' => true,
                'data' => $colecion->toArray(),
                'message' => 'Orden Acutalizado'
            ]);

        }else{
            return response()->json([
                'success' => false,
                'data' => $colecion->toArray(),
                'message' => 'No se enviaron opciones'
            ]);
        }
    }
}

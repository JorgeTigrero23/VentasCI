<?php

namespace App\Http\Controllers\Maintenances;

use App\Models\Category;
use Illuminate\Http\Request;

use App\DataTables\CategoryDataTable;
use App\Repositories\CategoryRepository;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use PDF;

class CategoryController extends AppBaseController
{
    /** @var  categoryRepository */
    private $categoryRepository;
    
    public function __construct(CategoryRepository $repo)
    {
        $this->middleware('auth');
        $this->categoryRepository = $repo;
    }

    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('maintenances.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenances.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $category = Category::create($request->all());

        Flash::success('Categoría creada con exito.');

        return redirect(route('categoria.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category)
    // {
    //     return view('maintenances.category.show')->with('category', $category);
    // }
    public function show($id)
    {
        $category = Category::findOrFail($id);

        if (empty($category)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categoria.index'));
        }

        return view('maintenances.category.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categoria.index'));
        }

        return view('maintenances.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\CategoryFormRequest  $request
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $category = $this->categoryRepository->update($request->all(), $id);

        Flash::success('Categoría modificada con exito.');

        return redirect(route('categoria.index')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(Category::destroy($id))) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categoria.index'));
        }

        Flash::success('Categoría eliminada con exito.');

        return redirect(route('categoria.index'));
    }

    public function report()
    {
        return view('reports.report-category');

    }

    public function viewReport()
    {	
        $categories = Category::all();

    	if(!empty($categories)){
            return self::createPDF($categories, 'view', 'Report-Categories');
        }else{
            return back();
        }

    }

    public function createPDF($collection, $type, $name)
   	{  

        $now = new \DateTime();

        $data = [
            'categories' => $collection, 
            'date' => $now->format('d-m-Y H:i:s'),

        ];

   		// $pdf = PDF::loadView('reports.templates.template-category', $data);

   		if($type == 'view'){
               
            // return $pdf->stream($name);
               
            $view = View('reports.templates.template-category', $data);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());

            return $pdf->stream();

   		}else if($type=='download'){

            $pdf = PDF::loadView('reports.templates.template-category', $data);

   			return $pdf->download($name.'['. $now->format('d-m-Y H:i:s'). '].pdf');

   		}

   	}
}

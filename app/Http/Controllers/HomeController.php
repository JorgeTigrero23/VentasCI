<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Charts;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $quantityClients = Client::count();
        $quantityProducts = Product::count();
        $quantityUsers = User::count();
        $quantitySales = Sale::count();

        $years = self::getDataSalesLastYear();

        return view('adminlte::home', compact('quantityClients', 'quantityProducts', 'quantityUsers', 'quantitySales', 'years'));
    }

    public function amountGraph(Request $request)
    {

        if( $request->has('year') )
        {
            $year = date("Y");
        }

        $result =  self::getDataAmountGraph($year);

        return response()->json($result);

    }

    private function getDataSalesLastYear()
    {
        if (env('DB_CONNECTION') == 'mysql')
        {
            return DB::table('sales')
                        ->select(DB::raw('YEAR(date) as year'))
                        ->groupBy('year')
                        ->orderBy('year')
                        ->get();
        }
        elseif (env('DB_CONNECTION') == 'pgsql')
        {
            return DB::table('sales')
            ->select(DB::raw('extract(year from date) as year'))
            ->groupBy('year')
            ->orderBy('year')
            ->get();
        }
    }

    private function getDataAmountGraph($year)
    {
        if (env('DB_CONNECTION') == 'mysql')
        {
            return DB::table('sales')->select(DB::raw('MONTH(date) as mes'), DB::raw('sum(TOTAL) monto'))
                                        ->where('date','>=', $year.'-01-01')
                                        ->where('date','<=', $year.'-12-31')
                                        ->groupBy('mes')
                                        ->orderBy('mes')
                                        ->get();
        }
        elseif (env('DB_CONNECTION') == 'pgsql')
        {
            return DB::table('sales')->select(DB::raw("to_char(date, 'Mon') as month"), DB::raw('sum(TOTAL) monto'))
                                        ->where('date','>=', $year.'-01-01')
                                        ->where('date','<=', $year.'-12-31')
                                        ->groupBy('month')
                                        ->orderBy('month')
                                        ->get();
        }
    }
}
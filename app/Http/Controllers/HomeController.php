<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculation;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calculation = Calculation::latest()->take(5)->get();
        return view('home', compact('calculation'));
    }

    public function calculate(Request $request){

        $math_string ="return (".$request->input_calculation.");";
        $output_calculation = eval($math_string);

        $calculation  = new Calculation();
        $calculation->input_calculation = $request->input_calculation;
        $calculation->output_calculation = $output_calculation;
        $calculation->save();

        $calculationhtmlcurrentupdated = '<div class="row m-2">
                                            <div class="col-lg-12">
                                                '.$request->input_calculation.' = '.$output_calculation.' <button class="btn btn-dark btn-sm delete" data-id="'.$calculation->id.'">Delete</button><br>
                                            </div>
                                        </div>';

        return response()->json(array('success' => 'true', 'calculationhtmlcurrentupdated' => $calculationhtmlcurrentupdated), 200);
    }

    public function calculatedelete(Request $request)
    {
        $del = Calculation::find($request->id);
        $del->delete();
        return response()->json(array('success' => 'true', 'id' => $request->id), 200);
    }
}

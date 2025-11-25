<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boya;
use Illuminate\Support\Facades\Auth;

class BoyaController extends Controller
{
    public function index()
    {
        $misboyas = Boya::where('id_user', Auth::id())->get();


        return view('boya.index', compact('misboyas'));
    }
    public function edit(){

    }

    public function show($id){
        $boya = Boya::find($id);

        return view( 'boya.show', compact('boya') );
    }

}

<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\BettingRepository;

class PrincipalController extends Controller
{
    public function index(BettingRepository $bettingRepository)
    {
        $list = $bettingRepository->list();
        return view('site.index', compact('list'));
    }

    public function sign($id)
    {
        dd('OK'.$id);
    }
    
    public function signNoLogin($id)
    {        
        return redirect()->route('principal');
    }
}

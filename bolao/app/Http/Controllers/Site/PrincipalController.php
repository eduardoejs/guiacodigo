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

    public function sign($id, BettingRepository $bettingRepository)
    {
        $bettingRepository->BettingUser($id);
        return redirect(route('principal').'#portfolio'); //redireciona para a rota e posiciona o foco da tela no id da section desejada
    }
    
    public function signNoLogin($id)
    {        
        return redirect()->route('principal');
    }
}

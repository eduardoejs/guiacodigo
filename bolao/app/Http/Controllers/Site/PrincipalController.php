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

    public function rounds($betting_id, BettingRepository $bettingRepository)
    {
        $list = $bettingRepository->rounds($betting_id);        
        $page = trans('bolao.round_list'); //Helper para Traduzir
        $columnList = ['id' => '#',
                       'title' => trans('bolao.title'),
                       'betting_title' => trans('bolao.betting_title'),
                       'date_start_site' => trans('bolao.date_start'),
                       'date_end_site' => trans('bolao.date_end')
                    ];
        
        if(!$list){
            return redirect(route('principal').'#portfolio');
        }

        $breadcrumb = [
            (object)['url' => route('principal').'#portfolio', 'title' => trans('bolao.betting_list')],
            (object)['url' => '', 'title' => trans('bolao.list', ['page' => $page])],
        ];

        return view('site.rounds', compact('list', 'page', 'columnList', 'breadcrumb'));            
    }
}

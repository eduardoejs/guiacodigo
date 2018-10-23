<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 25;
    private $search = ['name', 'email'];
    private $model;

    public function __construct(UserRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = trans('bolao.user_list'); //Helper para Traduzir
        $columnList = ['id' => '#', 'name' => trans('bolao.name'), 'email' => trans('bolao.email-address')];

        $search = "";
        if(isset($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search, $search, 'id', 'DESC');
        }else{
            $list = $this->model->paginate($this->paginate,'id', 'DESC'); //por padrao será de 10 itens mas posso passar aqui mais ou menos valores
        }

        $routeName = $this->route;

        //$request->session()->flash('msg', 'Task was successful!');
        //$request->session()->flash('status', 'notification');

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('bolao.home')],
            (object)['url' => '', 'title' => trans('bolao.list', ['page' => $page])],
        ];

        return view('admin.'.$routeName.'.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

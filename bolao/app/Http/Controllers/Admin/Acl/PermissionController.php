<?php

namespace App\Http\Controllers\Admin\Acl;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\PermissionRepository;

class PermissionController extends Controller
{
    private $route = 'permissions';
    private $paginate = 25;
    private $search = ['name', 'description'];
    private $model;

    public function __construct(PermissionRepository $model)
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
        $routeName = $this->route;
        $page = trans('bolao.permission_list'); //Helper para Traduzir
        $columnList = ['id' => '#', 'name' => trans('bolao.name'), 'description' => trans('bolao.description')];

        $search = "";
        if(isset($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search, $search, 'id', 'DESC');
        }else{
            $list = $this->model->paginate($this->paginate,'id', 'DESC'); //por padrao será de 10 itens mas posso passar aqui mais ou menos valores
        }

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('bolao.home')],
            (object)['url' => '', 'title' => trans('bolao.list', ['page' => $page])],
        ];

        return view('admin.acl.'.$routeName.'.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = $this->route;

        $page = trans('bolao.permission_list');
        $page_create = trans('bolao.permission');

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('bolao.home')],
            (object)['url' => route($routeName.'.index'), 'title' => trans('bolao.list', ['page' => $page])],
            (object)['url' => '', 'title' => trans('bolao.create_crud', ['page' => $page_create])],
        ];
        return view('admin.acl.'.$routeName.'.create', compact('page', 'page_create', 'routeName', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ])->validate();

        if($this->model->create($data)){
            session()->flash('msg', trans('bolao.add_record_success'));
            session()->flash('status', 'success');
        }else{
            session()->flash('msg', trans('bolao.add_record_error'));
            session()->flash('status', 'error');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);

        if($register){
            $page = trans('bolao.permission_list');
            $page_edit = trans('bolao.permission');

            $breadcrumb = [
                (object)['url' => route('home'), 'title' => trans('bolao.home')],
                (object)['url' => route($routeName.'.index'), 'title' => trans('bolao.list', ['page' => $page])],
                (object)['url' => '', 'title' => trans('bolao.show_crud', ['page' => $page_edit])],
            ];

            $delete = false;
            if($request->delete ?? false){
                session()->flash('msg', trans('bolao.delete_record'));
                session()->flash('status', 'alert');
                $delete = true;
            }

            return view('admin.acl.'.$routeName.'.show', compact('register', 'page', 'page_edit', 'routeName', 'breadcrumb', 'delete'));
        }

        session()->flash('msg', 'Registro não encontrado!');
        session()->flash('status', 'alert');
        return redirect()->route($routeName.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);

        if($register){
            $page = trans('bolao.permission_list');
            $page_edit = trans('bolao.permission');

            $breadcrumb = [
                (object)['url' => route('home'), 'title' => trans('bolao.home')],
                (object)['url' => route($routeName.'.index'), 'title' => trans('bolao.list', ['page' => $page])],
                (object)['url' => '', 'title' => trans('bolao.edit_crud', ['page' => $page_edit])],
            ];

            return view('admin.acl.'.$routeName.'.edit', compact('register', 'page', 'page_edit', 'routeName', 'breadcrumb'));
        }

        session()->flash('msg', 'Registro não encontrado!');
        session()->flash('status', 'alert');
        return redirect()->route($routeName.'.index');
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
        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ])->validate();

        if($this->model->update($data, $id)){
            session()->flash('msg', trans('bolao.edit_record_success'));
            session()->flash('status', 'success');
        }else{
            session()->flash('msg', trans('bolao.edit_record_error'));
            session()->flash('status', 'error');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routeName = $this->route;

        if($this->model->delete($id)) {
            session()->flash('msg', trans('bolao.record_deleted_success'));
            session()->flash('status', 'success');
        }else{
            session()->flash('msg', trans('bolao.record_deleted_error'));
            session()->flash('status', 'error');
        }

        return redirect()->route($routeName.'.index');
    }
}

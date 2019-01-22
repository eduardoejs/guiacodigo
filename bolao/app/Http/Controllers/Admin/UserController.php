<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use \App\Repositories\Eloquent\RoleRepository;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 25;
    private $search = ['name', 'email'];
    private $model;
    private $modelRole;

    public function __construct(UserRepository $model, RoleRepository $modelRole)
    {
        $this->model = $model;
        $this->modelRole = $modelRole;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('list-user');

        if(Gate::denies('list-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;
        $page = trans('bolao.user_list'); //Helper para Traduzir
        $columnList = ['id' => '#', 'name' => trans('bolao.name'), 'email' => trans('bolao.email-address')];

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

        return view('admin.'.$routeName.'.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('add-user');

        if(Gate::denies('add-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;

        $page = trans('bolao.user_list');
        $page_create = trans('bolao.user');

        $roles = $this->modelRole->all('description', 'ASC');

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('bolao.home')],
            (object)['url' => route($routeName.'.index'), 'title' => trans('bolao.list', ['page' => $page])],
            (object)['url' => '', 'title' => trans('bolao.create_crud', ['page' => $page_create])],
        ];
        return view('admin.'.$routeName.'.create', compact('page', 'roles' ,'page_create', 'routeName', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('add-user');

        if(Gate::denies('add-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        //$this->authorize('show-user');

        if(Gate::denies('show-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;
        $register = $this->model->find($id);

        if($register){
            $page = trans('bolao.user_list');
            $page_edit = trans('bolao.user');

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

            return view('admin.'.$routeName.'.show', compact('register', 'page', 'page_edit', 'routeName', 'breadcrumb', 'delete'));
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
        //$this->authorize('edit-user');

        if(Gate::denies('edit-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;
        $register = $this->model->find($id);

        if($register){
            $page = trans('bolao.user_list');
            $page_edit = trans('bolao.user');

            $roles = $this->modelRole->all('description', 'ASC');

            $breadcrumb = [
                (object)['url' => route('home'), 'title' => trans('bolao.home')],
                (object)['url' => route($routeName.'.index'), 'title' => trans('bolao.list', ['page' => $page])],
                (object)['url' => '', 'title' => trans('bolao.edit_crud', ['page' => $page_edit])],
            ];

            return view('admin.'.$routeName.'.edit', compact('register','roles', 'page', 'page_edit', 'routeName', 'breadcrumb'));
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
        //$this->authorize('edit-user');

        if(Gate::denies('edit-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();

        if(!$data['password']){
            unset($data['password']);
        }

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|required|string|min:6|confirmed',
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
        //$this->authorize('del-user');

        if(Gate::denies('del-user')){
            session()->flash('msg', trans('bolao.403'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

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

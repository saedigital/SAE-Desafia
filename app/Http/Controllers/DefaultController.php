<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefaultController extends Controller
{
    protected $model;
    protected $relationships = [];
    protected $rules = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function validation($request) {
        $validator = Validator::make($request->all(), $this->rules);
        return $validator;
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_size = $request->get('page_size') ?? 10;
        $order = $request->get('order') ?? 'id';
        $order_direction = $request->get('order_direction') ?? 'asc';
        $where = [];
        $fields = $this->model->getFillable();
        foreach ($fields as $field){
            if ($request->get($field)){
               $where[] = array($field, 'like', '%' . $request->get($field) . '%');
            }
        }
        $result = $this->model->orderBy($order, $order_direction)->where($where)->paginate($page_size);
        return view('layout.list', compact("result"), compact("fields"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if($validator->fails() ) {
            return response()->json([
                'message'   => 'Request failed',
                'errors'        => $validator->errors()
            ], 400);
        }
        $result = $this->model->create($request->all());
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->model->with($this->relationships)->findOrFail($id);
        return response()->json($result);
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
        $result = $this->model->findOrFail($id);
        $result->update($request->all());
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();
        return response()->json($result);
    }
}

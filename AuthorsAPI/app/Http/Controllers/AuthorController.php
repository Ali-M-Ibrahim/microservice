<?php

namespace App\Http\Controllers;

use App\Traits\APIResponse;
use App\Models\Author;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class AuthorController extends Controller
{

    use APIResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public  function index(){
        $data = Author::all();
        return $this->successResponse($data);
    }

    public  function store(Request $request){
        $rules = [
            'name'=>'required|max:255',
            'gender'=>'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ];
        $this->validate($request,$rules);
        $authors= Author::create($request->all());
        return $this->successResponse($authors,Response::HTTP_CREATED);
    }

    public  function show($id){
        $data= Author::findOrFail($id);
        return $this->successResponse($data);
    }


    public  function update(Request $request, $id){
        $rules = [
            'name'=>'max:255',
            'gender'=>'max:255|in:male,female',
            'country' => 'max:255'
        ];
        $this->validate($request,$rules);
        $data= Author::findOrFail($id);
        $data->fill($request->all());
        //will check if nothing has changes
        if($data->isClean()){
          return $this->errorResponse('At least one value must change',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data->save();
        return $this->successResponse($data);
    }

    public  function destroy($id){
        $data= Author::findOrFail($id);
        $data->delete();
        return $this->successResponse($data,Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\traits\APIResponse;
use Illuminate\Http\Response;

use Illuminate\Http\Request;


class BookController extends Controller
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
        $data = Book::all();
        return $this->successResponse($data);
    }

    public  function store(Request $request){
        $rules = [
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'price'=>'required|min:1',
            'author_id'=>'required|min:1',

        ];
        $this->validate($request,$rules);
        $data= Book::create($request->all());
        return $this->successResponse($data,Response::HTTP_CREATED);
    }

    public  function show($id){
        $data= Book::findOrFail($id);
        return $this->successResponse($data);
    }


    public  function update(Request $request, $id){
        $rules = [
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'price'=>'required|min:1',
            'author_id'=>'required|min:1',
        ];
        $this->validate($request,$rules);
        $data= Book::findOrFail($id);
        $data->fill($request->all());
        //will check if nothing has changes
        if($data->isClean()){
            return $this->errorResponse('At least one value must change',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data->save();
        return $this->successResponse($data);
    }

    public  function destroy($id){
        $data= Book::findOrFail($id);
        $data->delete();
        return $this->successResponse($data,Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\APIResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use APIResponse;
    public $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService=$authorService;
    }

    public  function index(){
      $data=  $this->authorService->obtainAuthors();
      return $this->successResponse($data);
    }

    public  function store(Request $request){
        $data=  $this->authorService->createAuthors($request->all());
        return $this->successResponse($data,Response::HTTP_CREATED);
    }

    public  function show($id){
        $data=  $this->authorService->obtainAuthor($id);
        return $this->successResponse($data);
    }

    public  function update(Request $request, $id){
        $data=  $this->authorService->EditAuthor($request->all(),$id);
        return $this->successResponse($data);
    }

    public  function destroy($id){
        $data=  $this->authorService->DeleteAuthor($id);
        return $this->successResponse($data);
    }
}

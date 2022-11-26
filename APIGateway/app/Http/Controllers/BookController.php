<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use APIResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $bookService;
    public $authorService;
    public function __construct(BookService $bookService,AuthorService $authorService)
    {
        $this->bookService=$bookService;
        $this->authorService=$authorService;
    }

    public  function index(){
        $data=  $this->bookService->obtainBooks();
        return $this->successResponse($data);
    }

    public  function store(Request $request){
        $this->authorService->obtainAuthor($request->author_id);
        $data=  $this->bookService->createBooks($request->all());
        return $this->successResponse($data,Response::HTTP_CREATED);
    }

    public  function show($id){
        $data=  $this->bookService->obtainBook($id);
        return $this->successResponse($data);
    }

    public  function update(Request $request, $id){
        $data=  $this->bookService->EditBook($request->all(),$id);
        return $this->successResponse($data);
    }

    public  function destroy($id){
        $data=  $this->bookService->DeleteBook($id);
        return $this->successResponse($data);
    }
}

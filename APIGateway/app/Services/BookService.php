<?php
namespace App\Services;

use App\Traits\ConsumeExternalService;

class BookService{

    use ConsumeExternalService;

    public $baseUri;
    public $secret;
    public function  __construct()
    {
        $this->baseUri= config('services.books.base_uri');
        $this->secret= config('services.books.secret');
    }

    public function obtainBooks(){
        return $this->performRequest('GET','/books');
    }

    public function createBooks($data){
        return $this->performRequest('POST','/books',$data);
    }

    public function obtainBook($id){
        return $this->performRequest('GET',"/books/{$id}");
    }

    public function EditBook($data, $id){
        return $this->performRequest('PUT',"/books/{$id}",$data);
    }
    public function DeleteBook($id){
        return $this->performRequest('DELETE',"/books/{$id}");
    }

}

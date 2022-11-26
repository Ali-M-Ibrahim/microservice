<?php
namespace App\Services;

use App\Traits\ConsumeExternalService;

class AuthorService{
    public $baseUri;
    public $secret;
    use ConsumeExternalService;
    public function  __construct()
    {
        $this->baseUri= config('services.authors.base_uri');
        $this->secret= config('services.authors.secret');
    }

    public function obtainAuthors(){
        return $this->performRequest('GET','/authors');
    }

    public function createAuthors($data){
        return $this->performRequest('POST','/authors',$data);
    }

    public function obtainAuthor($id){
        return $this->performRequest('GET',"/authors/{$id}");
    }

    public function EditAuthor($data, $id){
        return $this->performRequest('PUT',"/authors/{$id}",$data);
    }
    public function DeleteAuthor($id){
        return $this->performRequest('DELETE',"/authors/{$id}");
    }
}

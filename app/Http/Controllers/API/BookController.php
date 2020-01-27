<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Books;
use Validator;



class BookController extends BaseController
{

    //function pour afficher tous les books
    public function index(){

        $books = Books::all();
        return $this->sendResponse($books->toArray(),'Books read succesufly');
        
    }



    //function pour ajouter un book
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'=> 'required',
            'details' => 'required']);

            if($validator -> fails()){
                return $this->sendError('error validation',$validator->errors());
            }
        
        $book = Books::create($input);
        return $this->sendResponse($book->toArray(),'Book create succesufly');
    }


    //function pour afficher un book
    public function show($id){
      
        $book = Books::find($id);
       
            if(is_null($book)){
                return $this->sendError('error validation');

            }
        return $this->sendResponse($book->toArray(),'Book read succesufly');

    }


    //function pour update un book
    public function update (Request $request , Books $book){
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'=> 'required',
            'details' => 'required']);

            if($validator -> fails()){
                return $this->sendError('error validation',$validator->errors());
            }
        
         $book->name = $input['name'];
         $book->details = $input['details'];
         $book->save();
        return $this->sendResponse($book->toArray(),'Book updated succesufly');
    }


    //function pour delete un book
    public function destroy (Books $book){
        
      $book->delete();
        return $this->sendResponse($book->toArray(),'Book deleted succesufly');
    }

}

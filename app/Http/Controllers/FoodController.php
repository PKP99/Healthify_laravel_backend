<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Route;

class FoodController extends Controller
{
      public function create(Request $req){

        $food= new Food;
        $food->name= $req->fname;
        $food->calorific_value= $req->cvalue;
        $food->type= $req->type;
        $food->measurement_type= $req->mtype;

        $food->save();

           return response([
              'message'=>["Food created succesfully"]
          ]);     
      }

      public function read(){
          $val = 0;
          $food = Food::where('id','>',$val)->paginate(10);
          return $food;
      }

      public function search(Request $request){
      
        $term = $request->term;

        $food = Food::where('name', 'ilike', '%' . $term . '%')->get();
        return $food;
      }

      public function fooddata(Request $request){
      
        $term = $request->term;

        if($term = 'All'){
          $food = Food::all();
        }
        else{
        $food = Food::where('type',$term)->get();
        }
        return $food;
      }

      public function show($id){
        $food =Food::where('id',$id)->first();

        if(!$food){
           return response([
               'error'=>["Food not found!"]
           ]);
        }
        else return $food;
      }
      public function update(Request $req, $id){

          $food= Food::find($id);
          $food->name= $req->fname;
          $food->calorific_value= $req->cvalue;
          $food->type= $req->type;
          $food->measurement_type= $req->mtype;
          
          $food->save();

          return response([
              'message'=>["Food has been updated"]
          ]);     
        }
      public function destroy($id){
        $food = Food::findOrFail($id);
        $food->delete();

        return response([
              'message'=>["Food has been deleted"]
          ]);    
     }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\apiModel;
class apiController extends Controller
{
      private $model = null;
   
      public function __construct(){
         $this->model = new apiModel();
      }
      
      public function GetLastProjects(){
          return $this->model->GetLastProjects();
      }

      public function SearchProjects(Request $request,$keyword){
         return $this->model->SearchProjects($keyword);
      }

      public function GetInfoProject(Request $request,$projectName){
          return $this->model->GetInfoProject($projectName);
      }

      public function GetProjectRelations(Request $request,$projectName){
         return $this->model->GetProjectRelations($projectName);
      }

      public function GetFiltersSearch(Request $request,$keyword){
         return $this->model->GetFiltersSearch($keyword);
      }

      public function FiltersProject(Request $request){
         $data = $request->query();
         return $this->model->FiltersProject($data['keyword'],$data['language'],$data['categorie'],$data['creator']);
      }


}

<?php 

namespace App\Util;

use Illuminate\Database\Eloquent\Model;

abstract class  SparqlQueryHelper extends Model{
   
     protected function GetKeywordsProject($sparkClient,$name){
        $query = "
              SELECT distinct ?name ?keywords
              WHERE 
              {
                  ?project doap:name ?name.
                  ?project dc:subject ?keywords .
              }
              ORDER BY DESC(?name)
        ";
        $result = $sparkClient->query($query);
        $projectKeywords = [];
        foreach($result as $row){
            if($row->name->getValue() === $name){
              if(property_exists($row,"keywords")){
                $projectKeywords[] = $row->keywords->getValue();
              }
            }
        }
        return $projectKeywords;

    }

    protected function GetSoProject($sparkClient,$project){

        $query = "
        SELECT distinct ?name ?os
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL {?project doap:os ?os }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?os)
        ";
        $result = $sparkClient->query($query);
        $projectSo = [];

        foreach($result as $row){
            if($row->name->getValue() === $project){
                if(property_exists($row,"os")){
                    $projectSo[] = $row->os->getValue();
                }
            }
        }
        return $projectSo;

    }

    protected function GetRepositoryProject($sparkClient,$project){

        $query = "
        SELECT distinct ?name ?linkRepository
            WHERE 
            {
            ?project doap:name ?name.
            ?project doap:repository ?repository .
            ?repository doap:browse ?linkRepository.
            Filter REGEX(?name , '$project' , 'i')
            }
        ";
        $result = $sparkClient->query($query);
        $repository;
        foreach($result as $row){
          if(property_exists($row,"linkRepository")){
           $repository = $row->linkRepository->getValue();
          }else{
              $repository = null;
          }
        }
        return $repository;

    }

   protected function GetVersionProject($sparkClient,$project){

        $query = "
       SELECT distinct ?name ?revision ?created ?description
        WHERE 
        {
        ?project doap:name ?name .
        
        OPTIONAL { ?project doap:release ?version }
        OPTIONAL { ?version doap:revision ?revision }
        OPTIONAL { ?version doap:created ?created }
        OPTIONAL { ?version doap:description ?description }
        Filter REGEX(?name , '$project' , 'i')
        } 
        ";
        $result = $sparkClient->query($query);
        $version = [];
        foreach($result as $row){
           $version['revision'] = property_exists($row ,"revision") === true ? $row->revision->getValue():null;
           $version['created'] = property_exists($row ,"created") === true ? $row->created->getValue():null;
           $version['description'] = property_exists($row ,"description") === true ? $row->description->getValue():null;
        }
        return $version;

   }

   protected function GetEspecificationProject($sparkClient,$project){

          $query = "
      SELECT distinct ?name ?created ?description 
        WHERE 
        {
        ?project doap:name ?name .
        
        OPTIONAL 
        { 
            ?project doap:implements ?implements .
            ?implements doap:created ?created .
            ?implements doap:description ?description
        }

        Filter REGEX(?name , '$project' , 'i')
        } 
        ";
        $result = $sparkClient->query($query);
        $specification = [];
        foreach($result as $row){
           $specification['created'] = property_exists($row ,"created") === true ? $row->created->getValue():null;
           $specification['description'] = property_exists($row ,"description") === true ? $row->description->getValue():null;
        }
        return $specification;

   }

   protected function GetMonografiaProject($sparkClient,$project){

        $query = "
       SELECT distinct ?name ?nameCreator ?advisorName ?coadvisorName ?language ?linkMonografia
            WHERE 
            {
            ?project doap:name ?name ;
                    gitup:monografia ?monografia .

            ?monografia gitup:url ?linkMonografia ;
                        gitup:advisor ?advisor .

            ?advisor  foaf:name ?advisorName .
            OPTIONAL { 
                ?monografia gitup:coadvisor ?coadvisor .
                ?coadvisor  foaf:name ?coadvisorName
            }
            OPTIONAL { 
                ?monografia dc:creator ?creator .
                ?creator  foaf:name ?nameCreator
            }
            OPTIONAL { 
                ?monografia dc:language ?language
            }

            Filter REGEX(?name , '$project' , 'i')
      }
        ";
        $result = $sparkClient->query($query);
        $monografia = [];
        foreach($result as $row){
           $monografia['nameCreator'] = property_exists($row ,"nameCreator") === true ? $row->nameCreator->getValue():null;
           $monografia['advisorName'] = property_exists($row ,"advisorName") === true ? $row->advisorName->getValue():null;
           $monografia['coadvisorName'] = property_exists($row ,"coadvisorName") === true ? $row->coadvisorName->getValue():null;
           $monografia['language'] = property_exists($row ,"language") === true ? $row->language->getValue():null;
           $monografia['linkMonografia'] = property_exists($row ,"linkMonografia") === true ? $row->linkMonografia->getValue():null;
        }
        return $monografia;

   }

   protected function GetCategoryProject($sparkClient,$project){
         $query = "
      SELECT distinct ?name ?prefLabel ?altfLabel ?narrower ?broader ?related
            WHERE 
            {
            ?project doap:name ?name.

            OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:prefLabel ?prefLabel .
            }
            OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:altLabel ?altfLabel .
            }
            OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:narrower ?narrower .
            }
            OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:broader ?broader .
            }
            OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:related ?related .
            }

            Filter REGEX(?name , '$project' , 'i')
            }
        ";
        $result = $sparkClient->query($query);
        $category = [];
        foreach($result as $row){
           $category['prefLabel'] = property_exists($row ,"prefLabel") === true ? $row->prefLabel->getValue():null;
           $category['altfLabel'] = $this->GetAlternativeCategories($sparkClient,$row->name->getValue());
           $category['narrower'] = $this->GetChildCategories($sparkClient,$row->name->getValue());
           $category['broader']  =  $this->GetMotherCategories($sparkClient,$row->name->getValue());
           $category['related']  = $this->GetRelatedCategories($sparkClient,$row->name->getValue());
        }
        return $category;
   }

   private function GetAlternativeCategories($sparkClient,$project){

        $query = "
        SELECT distinct ?name ?altfLabel
        WHERE
        {
        ?project doap:name ?name .
        OPTIONAL 
        { 
            ?project gitup:category ?category .
            ?category skos:altLabel ?altfLabel .
        }

        Filter REGEX(?name , '$project' , 'i')
        }
       ";

         $result = $sparkClient->query($query);
         $alternativeCategories = [];

         foreach($result as $row){
             if(property_exists($row,"altfLabel")){
                 $alternativeCategories[] = $row->altfLabel->getValue();
             }
         }

         return $alternativeCategories;

   }


    private function GetChildCategories($sparkClient,$project){

        $query = "
        SELECT distinct ?name ?narrower
        WHERE
        {
        ?project doap:name ?name .
        OPTIONAL 
        {
            ?project gitup:category ?category .
            ?category skos:narrower ?narrower .
        }

        Filter REGEX(?name , '$project' , 'i')
        }
       ";

         $result = $sparkClient->query($query);
         $childCategories = [];

         foreach($result as $row){
             if(property_exists($row,"narrower")){
                 $childCategories[] = $row->narrower->getValue();
             }
         }

         return $childCategories;

   }


   private function GetMotherCategories($sparkClient,$project){
         $query = "
        SELECT distinct ?name ?broader
        WHERE
        {
        ?project doap:name ?name .
        OPTIONAL 
        { 
            ?project gitup:category ?category .
            ?category skos:broader ?broader .
        }

        Filter REGEX(?name , '$project' , 'i')
        }
       ";

         $result = $sparkClient->query($query);
         $motherCategories = [];

         foreach($result as $row){
             if(property_exists($row,"broader")){
                 $motherCategories[] = $row->broader->getValue();
             }
         }

         return $motherCategories;
   }

    private function GetRelatedCategories($sparkClient,$project){
         $query = "
       SELECT distinct ?name ?related
        WHERE
        {
        ?project doap:name ?name .
        OPTIONAL 
        { 
            ?project gitup:category ?category .
            ?category skos:related ?related .
        }

        Filter REGEX(?name , '$project' , 'i')
        }

       ";

         $result = $sparkClient->query($query);
         $relatedCategories = [];

         foreach($result as $row){
             if(property_exists($row,"related")){
                 $relatedCategories[] = $row->related->getValue();
             }
         }

         return $relatedCategories;
   }



   protected function GetDevelopersProject($sparkClient,$project){
       $query = "
          SELECT distinct ?name ?nameDeveloper
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL 
            {
                ?project doap:developer ?developer .
                ?developer foaf:name ?nameDeveloper .
            }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?nameDeveloper)
       ";

         $result = $sparkClient->query($query);
         $developers = [];

         foreach($result as $row){
             if(property_exists($row,"nameDeveloper")){
                 $developers[] = $row->nameDeveloper->getValue();
             }
         }

         return $developers;

   }



   protected function GetDocumentersProject($sparkClient,$project){
       $query = "
          SELECT distinct ?name ?nameDocumenter
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL 
            {
                ?project doap:documenter ?documenter .
                ?documenter foaf:name ?nameDocumenter .
            }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?nameDocumenter)
       ";

         $result = $sparkClient->query($query);
         $documenters = [];

         foreach($result as $row){
             if(property_exists($row,"nameDocumenter")){
                 $documenters[] = $row->nameDocumenter->getValue();
             }
         }

         return $documenters;

   }

   protected function GetTranslatorsProject($sparkClient,$project){

         $query = "
         SELECT distinct ?name ?nameTranslator 
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL 
            {
                ?project doap:documenter ?translator  .
                ?translator foaf:name ?nameTranslator  .
            }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?nameTranslator)
       ";

         $result = $sparkClient->query($query);
         $translators = [];

         foreach($result as $row){
             if(property_exists($row,"nameTranslator")){
                 $translators[] = $row->nameTranslator->getValue();
             }
         }

         return $translators;
   }

   protected function GetTestersProject($sparkClient,$project){

         $query = "
         SELECT distinct ?name ?nameTester  
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL 
            {
                ?project doap:documenter ?tester   .
                ?tester foaf:name ?nameTester   .
            }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?nameTester)
       ";

         $result = $sparkClient->query($query);
         $testers = [];

         foreach($result as $row){
             if(property_exists($row,"nameTester")){
                 $testers[] = $row->nameTester->getValue();
             }
         }

         return $testers;
   }


   protected function GetCollaboratorsProject($sparkClient,$project){

         $query = "
         SELECT distinct ?name ?nameHelper  
            WHERE 
            {
            ?project doap:name ?name.
            OPTIONAL 
            {
                ?project doap:documenter ?helper   .
                ?helper foaf:name ?nameHelper   .
            }
            Filter REGEX(?name , '$project' , 'i')
            }
            ORDER BY DESC(?nameHelper)
        ";

         $result = $sparkClient->query($query);
         $collaborators = [];

         foreach($result as $row){
             if(property_exists($row,"nameHelper")){
                 $collaborators[] = $row->nameHelper->getValue();
             }
         }

         return $collaborators;
   }

   protected function GetRequirementProject($sparkClient,$project){

          $query = "
         SELECT distinct ?name ?file ?improvement
            WHERE 
            {
            ?project doap:name ?name .

            OPTIONAL 
            {
                ?project gitup:requirements ?requirements .
                ?requirements gitup:file ?file 
            }
            OPTIONAL 
            { 
                ?project gitup:requirements ?requirements .
                ?requirements gitup:improvement ?improvement 
            }

            Filter REGEX(?name , '$project' , 'i')
            }

        ";

         $result = $sparkClient->query($query);
         $requirement = [];

         foreach($result as $row){
           $requirement['file'] = property_exists($row,'file') === true ? $row->file->getValue(): null;
           $requirement['improvement'] = property_exists($row,'improvement') === true ? $row->improvement->getValue(): null;
         }

         return $requirement;

   }






}
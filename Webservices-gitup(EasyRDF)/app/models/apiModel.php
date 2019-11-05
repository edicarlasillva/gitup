<?php

namespace App\models;

use App\Util\ResponseFormat;
use App\Util\SparqlQueryHelper;

class apiModel extends SparqlQueryHelper
{

    private $sparql = null; 
    public function __construct(){
         $this->RegisterNamespacesRDF();
         $this->RegisterEndpointClient();
    }

     private function RegisterNamespacesRDF(){
        \EasyRdf_Namespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
        \EasyRdf_Namespace::set('doap', 'http://usefulinc.com/ns/doap#');
        \EasyRdf_Namespace::set('dc', 'http://purl.org/dc/elements/1.1/');
        \EasyRdf_Namespace::set('skos', 'http://www.w3.org/2004/02/skos/core#');
        \EasyRdf_Namespace::set('gitup', 'http://ontologia.gitup.com.br:8890/gitup#');
     }

     private function RegisterEndpointClient(){
        $this->sparql = new \EasyRdf_Sparql_Client('http://ontologia.gitup.com.br:8890/sparql');
     }



        
      public function GetLastProjects(){
        try{
           
            $query = "SELECT distinct ?name ?created ?programmingLanguage ?nameCreator 
                WHERE {
                ?project doap:name ?name.
                ?project doap:created ?created .
                ?project doap:programming-language ?programmingLanguage .
                ?project gitup:monografia ?monografia .
                ?monografia dc:creator ?creator .
                ?creator foaf:name ?nameCreator .
                }
                ORDER BY DESC(?created)
            LIMIT 3
            ";
      
            $result = $this->sparql->query($query);
            $res = array();
            foreach($result as $row){
                $res[] = [
                    "name"=>$row->name->getValue(),
                    "nameCreator" => $row->nameCreator->getValue(),
                    "programmingLanguage"=>$row->programmingLanguage->getValue(),
                    "keywords"=> $this->GetKeywordsProject($this->sparql,$row->name->getValue()),
                    "created" => $row->created->getValue()
                ];
            }
        
            return ResponseFormat::Response(true,200,null,$res);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }
      }

      public function SearchProjects($keyword){
        try{   
            $query = "
            SELECT distinct ?name ?created ?programmingLanguage ?nameCreator
            WHERE 
            {
            ?project doap:name ?name.
            ?project doap:programming-language ?programmingLanguage .
            ?project gitup:monografia ?monografia .
            ?monografia dc:creator ?creator .
            ?creator foaf:name ?nameCreator .
            ?project dc:subject ?keywords .
            ?project doap:created ?created .
            Filter REGEX(?keywords , '$keyword.*' , 'i')
            }
            ";
            
            $result = $this->sparql->query($query);
            $res = array();
            foreach($result as $row){
                $res[] = [
                    "name"=>$row->name->getValue(),
                    "nameCreator" => $row->nameCreator->getValue(),
                    "programmingLanguage"=>$row->programmingLanguage->getValue(),
                    "keywords"=> $this->GetKeywordsProject($this->sparql,$row->name->getValue()),
                    "created" => $row->created->getValue()
                ];
            }
        
            return ResponseFormat::Response(true,200,null,$res);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }


      }

      public function GetInfoProject($projectName){
         
        try{   
            $query = "
              SELECT distinct 
                ?name 
                ?created 
                ?shortdesc 
                ?description 
                ?urlHomepage 
                ?urlOldHomepage 
                ?downloadPage 
                ?urlMailingList 
                ?bugDatabase 
                ?screenshots 
                ?license 
                ?programmingLanguage 
                ?nameMaintainer 
                ?nameDeveloper 
                ?nameDocumenter 
                ?nameTranslator 
                ?nameHelper 
                ?nameTester
                ?language
                WHERE
                {
                ?project doap:name ?name .
                ?project doap:created ?created .
                ?project doap:programming-language ?programmingLanguage .
                ?project doap:maintainer ?maintainer .
                ?maintainer foaf:name ?nameMaintainer .
                OPTIONAL { ?project doap:language ?language }

                OPTIONAL
                {
                    ?project doap:developer ?developer .
                    ?developer foaf:name ?nameDeveloper .
                }
                OPTIONAL
                {
                    ?project doap:documenter ?documenter .
                    ?documenter foaf:name ?nameDocumenter .
                }
                OPTIONAL
                {
                    ?project doap:translator ?translator .
                    ?translator foaf:name ?nameTranslator .
                }
                OPTIONAL
                {
                    ?project doap:helper ?helper .
                    ?helper foaf:name ?nameHelper .
                }
                OPTIONAL
                {
                    ?project doap:tester ?tester .
                    ?tester foaf:name ?nameTester .
                }
                OPTIONAL { ?project doap:shortdesc ?shortdesc }
                OPTIONAL { ?project doap:description ?description }
                OPTIONAL 
                { 
                    ?project doap:homepage ?homepage .
                    ?homepage gitup:url ?urlHomepage .
                }
                OPTIONAL 
                { 
                    ?project doap:old-homepage ?oldHomepage .
                    ?oldHomepage gitup:url ?urlOldHomepage .
                }
                OPTIONAL { ?project doap:download-page ?downloadPage }
                OPTIONAL 
                { 
                    ?project doap:mailing-list ?mailingList .
                    ?mailingList gitup:url ?urlMailingList .
                }
                OPTIONAL { ?project doap:bug-database ?bugDatabase }
                OPTIONAL { ?project doap:screenshots ?screenshots }
                OPTIONAL { ?project doap:license ?license }

                Filter REGEX(?name , '$projectName' , 'i')
                }
            ";
            
            $result = $this->sparql->query($query);
            $res = array();
            foreach($result as $row){

                $res[] = [
                    "name"=>$row->name->getValue(),
                    "created" => $row->created->getValue(),
                    "programmingLanguage" =>property_exists($row,'programmingLanguage') === true ? $row->programmingLanguage->getValue() : null,
                    "shortdesc" =>property_exists($row,'shortdesc') === true ? $row->shortdesc->getValue() : null,
                    "description" =>property_exists($row,'description') === true ? $row->description->getValue() : null,
                    "urlHomepage" => property_exists($row,'urlHomepage') === true ? $row->urlHomepage->getValue() : null,
                    "urlOldHomepage" => property_exists($row,'urlOldHomepage') === true ? $row->urlOldHomepage->getValue() : null,
                    "downloadPage" => property_exists($row,'downloadPage') === true ? $row->downloadPage->getValue() : null,
                    "urlMailingList" => property_exists($row,'urlMailingList') === true ? $row->urlMailingList->getValue() : null,
                    "bugDatabase" => property_exists($row,'bugDatabase') === true ? $row->bugDatabase->getValue() : null,
                    "screenshots" => property_exists($row,'screenshots') === true ? $row->screenshots->getValue() : null,
                    "linkRepository"=>$this->GetRepositoryProject($this->sparql,$row->name->getValue()),
                    "keywords"=>$this->GetKeywordsProject($this->sparql,$row->name->getValue()),
                    "so" => $this->GetSoProject($this->sparql,$row->name->getValue()),
                    "monografia"=>$this->GetMonografiaProject($this->sparql,$row->name->getValue()),
                    "specification"=>$this->GetEspecificationProject($this->sparql,$row->name->getValue()),
                    "categorys" => $this->GetCategoryProject($this->sparql,$row->name->getValue()),
                    "version" => $this->GetVersionProject($this->sparql,$row->name->getValue()),
                    "nameMaintainer" => property_exists($row,'nameMaintainer') === true ? $row->nameMaintainer->getValue() : null,
                    "nameDeveloper" => $this->GetDevelopersProject($this->sparql,$row->name->getValue()),
                    "nameDocumenter" => $this->GetDocumentersProject($this->sparql,$row->name->getValue()),
                    "nameTranslator" => $this->GetTranslatorsProject($this->sparql,$row->name->getValue()),
                    "nameHelper" => $this->GetCollaboratorsProject($this->sparql,$row->name->getValue()),
                    "nameTester" => $this->GetTestersProject($this->sparql,$row->name->getValue()),
                    "language" => property_exists($row,'language') === true ? $row->language->getValue() : null,
                    "requeriment" =>$this->GetRequirementProject($this->sparql,$row->name->getValue()),
                    "license" => property_exists($row,'license') === true ? $row->license->getValue() : null,

                ];
            }
        
            return ResponseFormat::Response(true,200,null,$res[0]);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }

      }


     public function GetProjectRelations($project){

         try{   
            $query = "
           SELECT distinct ?name ?nameProject ?programmingLanguage ?nameMaintainer 
                WHERE 
                {
                ?project doap:name ?name.
                ?project dc:relation ?relation .
                ?relation doap:name ?nameProject .
                ?relation doap:programming-language ?programmingLanguage .
                ?relation doap:maintainer ?maintainer .
                ?maintainer foaf:name ?nameMaintainer .
                Filter REGEX(?name , '$project' , 'i')
                }
                ORDER BY DESC(?name)
            ";
            
            $result = $this->sparql->query($query);
            $res = array();
            foreach($result as $row){
                $res[] = [
                    "name"=>$row->nameProject->getValue(),
                    "nameMaintainer" => $row->nameMaintainer->getValue(),
                    "programmingLanguage"=>$row->programmingLanguage->getValue(),
                    "keywords"=> $this->GetKeywordsProject($this->sparql,$row->nameProject->getValue())
                ];
            }
        
            return ResponseFormat::Response(true,200,null,$res);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }
         


     }

     public function GetFiltersSearch($keyword){

         try{

            $query = "
                SELECT distinct ?name  ?programmingLanguage ?prefLabel ?nameCreator
                WHERE 
                {
                ?project doap:name ?name.
                ?project dc:subject ?keywords .
                ?project doap:programming-language ?programmingLanguage .
                OPTIONAL 
                { 
                    ?project gitup:category ?category .
                    ?category skos:prefLabel ?prefLabel .
                }
                OPTIONAL 
                { 
                    ?project gitup:monografia ?monografia .
                    ?monografia dc:creator ?creator .
                    ?creator  foaf:name ?nameCreator .
                }
                Filter REGEX(?keywords , '$keyword.*' , 'i')
                }
                ORDER BY DESC(?name)
            ";
            
            $response = [];
            $programminLanguages = [];
            $creators = [];
            $categories = [];
            $result = $this->sparql->query($query);
            
            foreach($result as $row){
                if(property_exists($row,"programmingLanguage")){
                    $programminLanguages[] = $row->programmingLanguage->getValue();
                }

                if(property_exists($row,"prefLabel")){
                    $categories[] = $row->prefLabel->getValue();
                }

                if(property_exists($row,"nameCreator")){
                    $creators[] = $row->nameCreator->getValue();
                }

            }

            $response['languages'] = array_unique($programminLanguages);
            $response['creators'] = array_unique($creators);
            $response['categories'] = array_unique($categories);

            return ResponseFormat::Response(true,200,null,$response);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }


     }

    public function FiltersProject($keyword,$language,$categorie,$creator){
        $filters = "Filter (REGEX(?keywords , '$keyword.*' , 'i')";
           
           if($language != null){
               $filters.=" && REGEX(?programmingLanguage , '$language.*' , 'i')";
           }

           if($categorie != null){
               $filters.=" && REGEX(?prefLabel , '$categorie.*' , 'i')";
           }

           if($creator != null){
               $filters.=" && REGEX(?nameCreator , '$creator.*' , 'i')";
           }

        $filters.=")";

        try{   
            $query = "
            SELECT distinct ?name ?created ?programmingLanguage ?prefLabel  ?nameCreator
            WHERE 
            {
            ?project doap:name ?name.
            ?project doap:programming-language ?programmingLanguage .
             OPTIONAL 
            { 
                ?project gitup:category ?category .
                ?category skos:prefLabel ?prefLabel 
            }
            ?project gitup:monografia ?monografia .
            ?monografia dc:creator ?creator .
            ?creator foaf:name ?nameCreator .
            ?project dc:subject ?keywords .
            ?project doap:created ?created .

            $filters
            }
            ";
            
            $result = $this->sparql->query($query);
            $res = array();
            foreach($result as $row){
                $res[] = [
                    "name"=>$row->name->getValue(),
                    "nameCreator" => $row->nameCreator->getValue(),
                    "programmingLanguage"=>$row->programmingLanguage->getValue(),
                    "keywords"=> $this->GetKeywordsProject($this->sparql,$row->name->getValue()),
                    "created" => $row->created->getValue()
                ];
            }
        
            return ResponseFormat::Response(true,200,null,$res);
         }catch(\Exception $e){
            return ResponseFormat::Response(false,500,$e->getMessage(),null);
         }



    }





}

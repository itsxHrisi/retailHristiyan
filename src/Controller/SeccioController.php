<?php 
namespace App\SeccioController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class seccioS
{
    #[Route('/seccio/{codi}', name:'dades_seccio')]
    public function dades($codi){
        $objetos=[
        ["codi"=>"1","nom"=>"Roba","descripcio"=>"Roba","any"=>"2024","articles"=>["Pantalons","Camisa","Jersey","Xaqueta"]],
        ["codi"=>"2","nom"=>"Calzado","descripcio"=>"Zapatillas","any"=>"2023","articles"=>["Botas","Deportivas","Tacones"]],
        ["codi"=>"3","nom"=>"Roba interior","descripcio"=>"Roba interior","any"=>"2022","articles"=>["Calzoncillos","Bragas"]],
        ["codi"=>"4","nom"=>"Accesorio","descripcio"=>"Complementos","any"=>"2021","articles"=>["Gorros","Gorras","Bolsos","Collares"]]];
        foreach($objetos as $valor){
            if($codi===$valor["codi"]){
               return new JsonResponse($valor); 
            }
        }
        return new JsonResponse("Objeto no encontrado");
    }
}

?>
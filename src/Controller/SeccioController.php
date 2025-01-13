<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeccioController
{
    #[Route('/seccio/{codi}', name: 'dades_seccio')]
    public function dades($codi): JsonResponse
    {
        // Define the data set
        $objetos = [
            ["codi" => "1", "nom" => "Roba", "descripcio" => "Roba", "any" => "2024", "articles" => ["Pantalons", "Camisa", "Jersey", "Xaqueta"]],
            ["codi" => "2", "nom" => "Calzado", "descripcio" => "Zapatillas", "any" => "2023", "articles" => ["Botas", "Deportivas", "Tacones"]],
            ["codi" => "3", "nom" => "Roba interior", "descripcio" => "Roba interior", "any" => "2022", "articles" => ["Calzoncillos", "Bragas"]],
            ["codi" => "4", "nom" => "Accesorio", "descripcio" => "Complementos", "any" => "2021", "articles" => ["Gorros", "Gorras", "Bolsos", "Collares"]]
        ];

        // Search for the object by codi
        foreach ($objetos as $valor) {
            if ($codi === $valor["codi"]) {
                // Return the found object as JSON
                return new JsonResponse($valor);
            }
        }

        // If not found, return a 404 response with an error message
        return new JsonResponse(['error' => 'Objeto no encontrado'], Response::HTTP_NOT_FOUND);
    }
}
?>

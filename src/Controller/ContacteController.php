<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class ContacteController extends AbstractController
{
    private $contactes = [
        ["codi" => 1, "nom" => "Juan Pérez", "telefon" => "123456789", "email" => "juan@example.com"],
        ["codi" => 2, "nom" => "Ana García", "telefon" => "987654321", "email" => "ana@example.com"],
        ["codi" => 3, "nom" => "Carlos López", "telefon" => "555888777", "email" => "carlos@example.com"],
        // Agrega más contactos si es necesario
    ];
    #[Route('/contacte/{codi}' ,name:'fitxa_contacte', requirements: ['codi' => '\d+'])]
    public function fitxa($codi)
    {
    $resultat = array_filter($this->contactes,
    function($contacte) use ($codi)
    {
    return $contacte["codi"] == $codi;
    });
    if (count($resultat) > 0)
    return $this->render('fitxa_contacte.html.twig', array(
    'contacte' => array_shift($resultat)));
    else
    return $this->render('fitxa_contacte.html.twig', array(
    'contacte' => NULL));
    }#[Route('/contacte/{text}', name: 'buscar_contacte')]
public function buscar(string $text)
{
    // Filtrar los contactos que coincidan con el texto en el nombre
    $resultat = array_filter($this->contactes, function($contacte) use ($text) {
        return strpos(strtolower($contacte["nom"]), strtolower($text)) !== false;
    });

    // Si no hay resultados, podemos mostrar un mensaje adecuado
    if (empty($resultat)) {
        // Si no hay contactos encontrados, puedes manejar el caso como prefieras.
        // Por ejemplo, podemos pasar un mensaje a la plantilla:
        $resultat = ['mensaje' => 'No se encontró el contacto'];
    }

    return $this->render('llista_contactes.html.twig', [
        'contactes' => $resultat
    ]);
}
}
?>
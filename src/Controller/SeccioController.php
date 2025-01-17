<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ServeiDadesSeccio;

class SeccioController extends AbstractController
{
    private array $equipos = [
        [
            'nombre' => 'Madrid',
            'ciudad' => 'Ciudad A',
            'fundado' => 1990,
            'imagen' => ''
        ],
        [
            'nombre' => 'Barcelona',
            'ciudad' => 'Ciudad B',
            'fundado' => 1985,
            'imagen' => 'https://via.placeholder.com/400'
        ],
        [
            'nombre' => 'Villareal',
            'ciudad' => 'Ciudad C',
            'fundado' => 2000,
            'imagen' => 'https://via.placeholder.com/400'
        ],
    ];

    private array $arraySeccions; 

    public function __construct(ServeiDadesSeccio $dadesSeccio)
    {
        $this->arraySeccions = $dadesSeccio->get(); 
    }

    #[Route('/seccions', name: 'dades_seccions')]
    public function seccions()
    {
        return $this->render('dades_seccions.html.twig', ['arraySeccions' => $this->arraySeccions]);
    }

    #[Route('/seccio/detalls/{codi<\d+>?1}', name: 'detalls')]
    public function detall(int $codi) {
    
        $longitudArray = count($this->arraySeccions);
    
        if ($codi >= 0 && $codi <= $longitudArray) {
            $resultat = array_filter($this->arraySeccions, function($seccio) use ($codi) {
                return $seccio["codi"] == $codi;
            });
    
            if (count($resultat) > 0) {
                return $this->render('detalls.html.twig', array('seccio' => array_shift($resultat)));
            }
        } else {
            return new Response("<h1>Codigo seccion no encontrado</h1>");
        }
    }
    

    #[Route('/seccio/{codi<\d+>?1}', name: 'dades_seccio')]
    public function seccio($codi)
    {
        $resultat = array_filter($this->arraySeccions, function ($seccio) use ($codi) {
            return $seccio['codi'] == $codi;
        });

        if (count($resultat) > 0) {
            $resultat = array_shift($resultat);

            // Formatear los artículos
            $articlesHtml = '<ul>';
            foreach ($resultat['articles'] as $article) {
                $articlesHtml .= "<li>$article</li>";
            }
            $articlesHtml .= '</ul>';

            // Generar la respuesta completa
            $resposta = "
                <ul>
                    <li><strong>Nombre:</strong> {$resultat['nom']}</li>
                    <li><strong>Descripción:</strong> {$resultat['descripcio']}</li>
                    <li><strong>Artículos:</strong> $articlesHtml</li>
                </ul>
            ";

            return new Response("<html><body>$resposta</body></html>");
        } else {
            return new Response("<html><body>Sección no encontrada</body></html>");
        }
    }

    

    // Ruta que recibe el parámetro 'text' para buscar el equipo
    #[Route('/equips/{text}', name: 'dades_equip', requirements: ['text' => '.+'])]
    public function mostrarEquipo(string $text): Response
    {
        // Buscar el equipo en el array de equipos
        $equipo = array_filter($this->equipos, function ($e) use ($text) {
            return strtolower($e['nombre']) === strtolower($text);
        });

        // Si el equipo existe
        if (!empty($equipo)) {
            $equipo = array_shift($equipo); // Obtener el primer resultado

            // Renderizar la plantilla 'dades_equip.html.twig' con los datos del equipo
            return $this->render('dades_equip.html.twig', [
                'equipo' => $equipo
            ]);
        } else {
            // Si el equipo no se encuentra, enviar un mensaje de error
            return $this->render('dades_equip.html.twig', [
                'error' => 'El equipo no existe'
            ]);
        }
    }
}
?>

<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Service\ServeiDadesSeccio;

class IniciController extends AbstractController
{
    private array $arraySeccions;
    private LoggerInterface $logger;

    // Constructor único para manejar la inyección de dependencias
    public function __construct(ServeiDadesSeccio $dadesSeccio, LoggerInterface $logger)
    {
        $this->arraySeccions = $dadesSeccio->get(); 
        $this->logger = $logger;
    }

    #[Route('/', name: 'inici')]
    public function inici(): Response
    {
        $data_hora = new \DateTime();
        $this->logger->info("Accés el " . $data_hora->format("d/m/y H:i:s"));
        return $this->render('base.html.twig');
    }

    #[Route('/inici', name: 'inici1')]
    public function SeccionInici(): Response
    {
        return $this->render('inici.html.twig', [
            'arraySeccions' => $this->arraySeccions,
        ]);
    }
}

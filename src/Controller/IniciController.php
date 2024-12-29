<?php 
namespace App\Controller\IniciController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class inici
{
    #[Route('/', name:'inici')]
    public function inici(){
        return new Response("Projecte Gestio de Retail de 2n de DAW");
    }
}

?>
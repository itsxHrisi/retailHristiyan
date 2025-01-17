<?php
namespace App\Service;

class ServeiDadesSeccio
{
    private array $arraySeccions = [
        ["codi" => "1", "nom" => "Ropa", "descripcio" => "Roba", "any" => "2024", "articles" => ["Pantalons", "Camisa", "Jersey", "Xaqueta"],"imatge"=>"/assets/img/bob.png"],
        ["codi" => "2", "nom" => "Calzado", "descripcio" => "Zapatillas", "any" => "2023", "articles" => ["Botas", "Deportivas", "Tacones"],"imatge"=>"/assets/img/bob.png"],
        ["codi" => "3", "nom" => "Ropa interior", "descripcio" => "Roba interior", "any" => "2022", "articles" => ["Calzoncillos", "Bragas"],"imatge"=>"/assets/img/bob.png"],
        ["codi" => "4", "nom" => "Accesorio", "descripcio" => "Complementos", "any" => "2021", "articles" => ["Gorros", "Gorras", "Bolsos", "Collares"],"imatge"=>"/assets/img/bob.png"]
    ];

    public function get(): array
    {
        return $this->arraySeccions;
    }
}
?>

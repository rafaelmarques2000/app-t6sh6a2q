<?php
namespace App\Packages\Produto\Domain\Model;

use App\Packages\Doctrine\Behavior\Identifiable;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Produto
{
    use Identifiable;

    /** @ORM\Column(type="string") */
    private string $sku;

    /** @ORM\Column(type="string") */
    private string $nome;

    /** @ORM\Column(type="string") */
    private string $quantidadeInicial;

    public function __construct(string $sku, string $nome, string $quantidadeInicial)
    {
        $this->sku = $sku;
        $this->nome = $nome;
        $this->quantidadeInicial = $quantidadeInicial;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getQuantidadeInicial(): string
    {
        return $this->quantidadeInicial;
    }
}

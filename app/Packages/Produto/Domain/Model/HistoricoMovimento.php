<?php

namespace App\Packages\Produto\Domain\Model;

use App\Packages\Doctrine\Behavior\Identifiable;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class HistoricoMovimento
{
    use Identifiable;

    const OPERACAO_ENTRADA= 'entrada';
    const OPERACAO_SAIDA = 'saida';

    /** @ORM\Column(type="string") */
    private string $sku;

    /** @ORM\Column(type="integer") */
    private string $quantidade;

    /** @ORM\Column(type="datetime") */
    private \DateTime $dataMovimentacao;

    /** @ORM\Column(type="string") */
    private string $operacao;

    /** @ORM\ManyToOne(targetEntity="Produto", inversedBy="historicoMovimento") */
    private Produto $produto;

    public function __construct(string $sku, string $quantidade, \DateTime $dataMovimentacao, string $operacao, Produto $produto)
    {
        $this->sku = $sku;
        $this->quantidade = $quantidade;
        $this->dataMovimentacao = $dataMovimentacao;
        $this->operacao = $operacao;
        $this->produto = $produto;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

    public function getDataMovimentacao(): \DateTime
    {
        return $this->dataMovimentacao;
    }

    public function getOperacao(): string
    {
        return $this->operacao;
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }
}

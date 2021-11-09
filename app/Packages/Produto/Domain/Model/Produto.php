<?php

namespace App\Packages\Produto\Domain\Model;

use App\Packages\Doctrine\Behavior\Identifiable;
use App\Packages\Produto\Domain\Factories\HistoricoMovimentoFactory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Produto
{
    use Identifiable;

    const SEM_PRODUTOS_DISPONIVEIS = 0;

    /** @ORM\Column(type="string") */
    private string $sku;

    /** @ORM\Column(type="string") */
    private string $nome;

    /** @ORM\Column(type="string") */
    private string $quantidadeInicial;

    /** @ORM\OneToMany(targetEntity="App\Packages\Produto\Domain\Model\HistoricoMovimento", mappedBy="produto", fetch="EXTRA_LAZY", cascade={"all"}) */
    private Collection $historicoMovimento;

    public function __construct(string $sku, string $nome, string $quantidadeInicial)
    {
        $this->sku = $sku;
        $this->nome = $nome;
        $this->quantidadeInicial = $quantidadeInicial;
        $this->historicoMovimento = new ArrayCollection();
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

    public function adicionarProdutoEstoque(int $quantidade): void
    {
        $this->quantidadeInicial += $quantidade;
        $historicoMovimento = HistoricoMovimentoFactory::create(
            $this->getSku(),
            $quantidade,
            HistoricoMovimento::OPERACAO_ENTRADA
        );
        $this->adicionarMovimentoHistorico($historicoMovimento);
    }

    public function baixarProdutoEstoque(int $quantidade)
    {
        if ($this->quantidadeInicial <= self::SEM_PRODUTOS_DISPONIVEIS) {
            throw new \Exception('Este produto não está disponivel', 1636495698);
        }
        $this->quantidadeInicial -= $quantidade;
        $historicoMovimento = HistoricoMovimentoFactory::create(
            $this->getSku(),
            $quantidade,
            HistoricoMovimento::OPERACAO_SAIDA
        );
        $this->adicionarMovimentoHistorico($historicoMovimento);
    }

    public function adicionarMovimentoHistorico(HistoricoMovimento $historicoMovimento): void
    {
        $this->historicoMovimento->add($historicoMovimento);
    }

    public function getHistoricoMovimento(): Collection
    {
        return $this->historicoMovimento;
    }
}

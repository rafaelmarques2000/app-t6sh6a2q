<?php

namespace App\Packages\Produto;

use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Domain\Repository\ProdutoRepositoryInterface;
use App\Packages\Produto\Dto\ProdutoEstoqueRequestDto;
use App\Packages\Produto\Dto\ProdutoRequestDto;
use App\Packages\Produto\Factories\ProdutoFactory;
use Illuminate\Support\Collection;

class ProdutoFacade
{
    private ProdutoRepositoryInterface $produtoRepository;
    private ProdutoFactory $produtoFactory;

    public function __construct(
        ProdutoRepositoryInterface $produtoRepository,
        ProdutoFactory $produtoFactory
    )
    {
        $this->produtoRepository = $produtoRepository;
        $this->produtoFactory = $produtoFactory;
    }

    public function getAll(): Collection
    {
        return $this->produtoRepository->getAll();
    }

    public function create(ProdutoRequestDto $produtoRequestDto): Produto
    {
        $produto = $this->produtoFactory::create($produtoRequestDto);
        $produto = $this->produtoRepository->create($produto);
        return $produto;
    }

    public function adicionarProdutoEstoque(Produto $produto, ProdutoEstoqueRequestDto $produtoEstoqueRequestDto): Produto
    {
        $produto->adicionarProdutoEstoque($produtoEstoqueRequestDto->getQuantidade());
        $this->produtoRepository->update($produto);
        return $produto;
    }

    public function baixarProdutoNoEstoque(Produto $produto, ProdutoEstoqueRequestDto $produtoEstoqueRequestDto): Produto
    {
        $produto->baixarProdutoEstoque($produtoEstoqueRequestDto->getQuantidade());
        $this->produtoRepository->update($produto);
        return $produto;
    }
}

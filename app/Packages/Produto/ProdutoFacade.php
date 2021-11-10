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
        if ($this->produtoRepository->getBySku($produtoRequestDto->getSku()) instanceof Produto) {
            throw new \Exception('Codigo Sku já cadastrado', 1636500056);
        }

        $produto = $this->produtoFactory::create($produtoRequestDto);
        $produto = $this->produtoRepository->create($produto);
        return $produto;
    }

    public function adicionarProdutoEstoque(Produto $produto, ProdutoEstoqueRequestDto $produtoEstoqueRequestDto): Produto
    {
        if (!$this->produtoRepository->getBySku($produtoEstoqueRequestDto->getSku()) instanceof Produto) {
            throw new \Exception('Codigo Sku não encontrado', 1636505134);
        }

        $produto->adicionarProdutoEstoque($produtoEstoqueRequestDto->getQuantidade());
        $this->produtoRepository->update($produto);
        return $produto;
    }

    public function baixarProdutoNoEstoque(Produto $produto, ProdutoEstoqueRequestDto $produtoEstoqueRequestDto): Produto
    {
        if (!$this->produtoRepository->getBySku($produtoEstoqueRequestDto->getSku()) instanceof Produto) {
            throw new \Exception('Codigo Sku não encontrado', 1636505131);
        }

        $produto->baixarProdutoEstoque($produtoEstoqueRequestDto->getQuantidade());
        $this->produtoRepository->update($produto);
        return $produto;
    }
}

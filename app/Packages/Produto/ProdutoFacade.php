<?php

namespace App\Packages\Produto;

use App\Packages\Produto\Domain\Repository\ProdutoRepositoryInterface;
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

    public function create(ProdutoRequestDto $produtoRequestDto)
    {
        $produto = $this->produtoFactory::create($produtoRequestDto);
        $produto = $this->produtoRepository->create($produto);
        return $produto;
    }
}

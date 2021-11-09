<?php

namespace App\Packages\Produto\Factories;

use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Dto\ProdutoRequestDto;

class ProdutoFactory
{
    public static function create(ProdutoRequestDto $produtoRequestDto): Produto
    {
        return new Produto(
            $produtoRequestDto->getSku(),
            $produtoRequestDto->getNome(),
            $produtoRequestDto->getQuantidadeInicial()
        );
    }
}

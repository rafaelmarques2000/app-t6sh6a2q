<?php

namespace App\Packages\Produto\Response;

use App\Packages\Base\AbstractResponse;
use App\Packages\Produto\Domain\Model\Produto;

class ProdutoResponse extends AbstractResponse
{
    private Produto $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    function getResponseData(): array
    {
        return [
            'id' => $this->produto->getId(),
            'sku' => $this->produto->getSku(),
            'nome' => $this->produto->getNome(),
            'quantidadeInicial' => $this->produto->getQuantidadeInicial()
        ];
    }
}

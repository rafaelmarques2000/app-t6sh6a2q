<?php

namespace App\Packages\Produto\Response;

use App\Packages\Base\AbstractResponse;
use App\Packages\Produto\Domain\Model\Produto;
use Illuminate\Support\Collection;

class ProdutoListResponse extends AbstractResponse
{
    private Collection $produtos;

    public function __construct(Collection $produtos)
    {
        $this->produtos = $produtos;
    }

    public function getResponseData(): array
    {
        return $this->produtos->map(fn(Produto $produto) => $this->formatProduto($produto))->toArray();
    }

    private function formatProduto(Produto $produto)
    {
        return [
            'id' => $produto->getId(),
            'sku' => $produto->getSku(),
            'nome' => $produto->getNome(),
            'quantidadeInicial' => $produto->getQuantidadeInicial()
        ];
    }
}

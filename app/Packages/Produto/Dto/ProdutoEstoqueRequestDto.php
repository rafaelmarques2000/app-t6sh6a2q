<?php

namespace App\Packages\Produto\Dto;

use Illuminate\Http\Request;

class ProdutoEstoqueRequestDto
{
    private string $sku;
    private int $quantidade;

    private function __construct(string $sku,int $quantidade)
    {
        $this->sku = $sku;
        $this->quantidade = $quantidade;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->get('sku'),
            $request->get('quantidade')
        );
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
}

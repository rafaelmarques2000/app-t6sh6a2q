<?php

namespace App\Packages\Produto\Dto;

use Illuminate\Http\Request;

class ProdutoRequestDto
{
    private string $sku;

    private string $nome;

    private int $quantidadeInicial;

    private function __construct(string $sku, string $nome, int $quantidadeInicial)
    {
        $this->sku = $sku;
        $this->nome = $nome;
        $this->quantidadeInicial = $quantidadeInicial;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->get('sku'),
            $request->get('nome'),
            $request->get('quantidadeInicial')
        );
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getQuantidadeInicial(): int
    {
        return $this->quantidadeInicial;
    }
}

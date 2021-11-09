<?php

namespace App\Packages\Produto\Domain\Factories;

use App\Packages\Produto\Domain\Model\HistoricoMovimento;
use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Dto\ProdutoRequestDto;
use Carbon\Carbon;

class HistoricoMovimentoFactory
{
    public static function create(string $sku, int $quantidade, string $operacao, Produto $produto): HistoricoMovimento
    {
        return new HistoricoMovimento(
            $sku,
            $quantidade,
            Carbon::now(),
            $operacao,
            $produto
        );
    }
}

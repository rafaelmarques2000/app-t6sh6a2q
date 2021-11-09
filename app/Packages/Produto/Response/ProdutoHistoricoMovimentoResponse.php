<?php

namespace App\Packages\Produto\Response;

use App\Packages\Base\AbstractResponse;
use App\Packages\Produto\Domain\Model\HistoricoMovimento;
use App\Packages\Produto\Domain\Model\Produto;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;

class ProdutoHistoricoMovimentoResponse extends AbstractResponse
{
    private Produto $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    function getResponseData(): array
    {
        return $this->produto->getHistoricoMovimento()
            ->map(fn(HistoricoMovimento $historicoMovimento) => $this->formatHistoricoMovimento($historicoMovimento))->toArray();
    }

    private function formatHistoricoMovimento(HistoricoMovimento $historicoMovimento)
    {
        return [
            'sku' => $historicoMovimento->getSku(),
            'quantidade' => $historicoMovimento->getQuantidade(),
            'dataHora' => Carbon::createFromDate($historicoMovimento->getDataMovimentacao())->format(DATE_ATOM),
            'operacao' => $historicoMovimento->getOperacao()
        ];
    }
}

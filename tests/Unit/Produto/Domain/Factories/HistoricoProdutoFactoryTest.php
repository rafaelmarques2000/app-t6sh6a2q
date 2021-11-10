<?php

namespace Unit\Produto\Domain\Factories;

use App\Packages\Produto\Domain\Factories\HistoricoMovimentoFactory;
use App\Packages\Produto\Domain\Model\HistoricoMovimento;
use App\Packages\Produto\Domain\Model\Produto;
use Carbon\Carbon;
use Tests\TestCase;

class HistoricoProdutoFactoryTest extends TestCase
{

    public function testSeCriaHistoricoDoProduto()
    {
        Carbon::setTestNow('2021-11-01');
        //GIVEN

        $produtoMock = $this->createMock(Produto::class);
        $sku = 'BR/200';
        $quantidade = 100;
        $operacao = HistoricoMovimento::OPERACAO_ENTRADA;

        //WHEN

        $historicoMovimento = HistoricoMovimentoFactory::create($sku,$quantidade,$operacao,$produtoMock);

        //THEN

        $this->assertInstanceOf(HistoricoMovimento::class, $historicoMovimento);
        $this->assertEquals($sku, $historicoMovimento->getSku());
        $this->assertEquals($quantidade, $historicoMovimento->getQuantidade());
        $this->assertEquals($operacao, $historicoMovimento->getOperacao());
    }


}

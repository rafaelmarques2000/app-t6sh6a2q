<?php

namespace Unit\Produto\Domain\Domain;

use App\Packages\Produto\Domain\Model\Produto;
use Tests\TestCase;

class ProdutoTest extends TestCase
{

    public function testSeAdicionaProdutoNoEstoque()
    {
        //Given
        $sku = 'BR/500';
        $quantidadeProdutoInicial = 10;
        $quantidadeProdutoEsperada = 15;
        $quantidadeProdutosParaEntrar = 5;
        $totalHistoricoMovimento = 1;
        $produto = new Produto($sku, '', $quantidadeProdutoInicial);

        //WHEN
        $produto->adicionarProdutoEstoque($quantidadeProdutosParaEntrar);

        //THEN

        $this->assertEquals($quantidadeProdutoEsperada, $produto->getQuantidadeInicial());
        $this->assertCount($totalHistoricoMovimento, $produto->getHistoricoMovimento());
    }

    public function testSeDaBaixaProdutoNoEstoque()
    {
        //Given
        $sku = 'BR/500';
        $quantidadeProdutoInicial = 10;
        $quantidadeProdutoEsperada = 5;
        $quantidadeProdutosParaBaixa = 5;
        $totalHistoricoMovimento = 1;
        $produto = new Produto($sku, '', $quantidadeProdutoInicial);

        //WHEN
        $produto->baixarProdutoEstoque($quantidadeProdutosParaBaixa);

        //THEN

        $this->assertEquals($quantidadeProdutoEsperada, $produto->getQuantidadeInicial());
        $this->assertCount($totalHistoricoMovimento, $produto->getHistoricoMovimento());
    }

    public function testSeAoBaixarProdutoSemEstoqueLevantaExcecao()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Este produto não está disponivel ou não possui estoque');
        $this->expectExceptionCode(1636495698);

        //Given
        $sku = 'BR/500';
        $quantidadeProdutoInicial = 0;
        $quantidadeProdutoEsperada = 5;
        $quantidadeProdutosParaBaixa = 5;
        $totalHistoricoMovimento = 1;
        $produto = new Produto($sku, '', $quantidadeProdutoInicial);

        //WHEN
        $produto->baixarProdutoEstoque($quantidadeProdutosParaBaixa);

        //THEN

        $this->assertEquals($quantidadeProdutoEsperada, $produto->getQuantidadeInicial());
        $this->assertCount($totalHistoricoMovimento, $produto->getHistoricoMovimento());
    }

    public function testSeAoBaixarProdutoComMaiorQuantidadeDoQueDisponivelLevantaExcecao()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Não há produtos suficientes para retirada');
        $this->expectExceptionCode(1636498091);

        //Given
        $sku = 'BR/500';
        $quantidadeProdutoInicial = 10;
        $quantidadeProdutoEsperada = 5;
        $quantidadeProdutosParaBaixa = 50;
        $totalHistoricoMovimento = 1;
        $produto = new Produto($sku, '', $quantidadeProdutoInicial);

        //WHEN
        $produto->baixarProdutoEstoque($quantidadeProdutosParaBaixa);

        //THEN

        $this->assertEquals($quantidadeProdutoEsperada, $produto->getQuantidadeInicial());
        $this->assertCount($totalHistoricoMovimento, $produto->getHistoricoMovimento());
    }

}


<?php

namespace Unit\Produto\Factories;

use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Dto\ProdutoRequestDto;
use App\Packages\Produto\Factories\ProdutoFactory;
use App\Packages\Produto\Request\ProdutoRequest;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

class ProdutoFactoryTest extends TestCase
{

    public function testSeCriaOProduto()
    {
        //GIVEN
        $sku = 'BR/200';
        $nome = 'IPHONE 12 128GB';
        $quantidade = 100;

        $produtoRequest = new ProdutoRequest([
            'sku' => 'BR/200',
            'nome' => 'IPHONE 12 128GB',
            'quantidadeInicial' => 100
        ]);
        //WHEN
        /** @var Produto $produto */
        $produto = ProdutoFactory::create(ProdutoRequestDto::fromRequest($produtoRequest));

        //THEN
        $this->assertInstanceOf(Produto::class, $produto);
        $this->assertEquals($sku, $produto->getSku());
        $this->assertEquals($nome, $produto->getNome());
        $this->assertEquals($quantidade, $produto->getQuantidadeInicial());
    }

}

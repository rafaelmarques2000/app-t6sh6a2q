<?php

namespace App\Http\Controllers;

use App\Packages\Base\HttpStatus;
use App\Packages\Base\Response\ErrorResponse;
use App\Packages\Base\Response\NoContentResponse;
use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Dto\ProdutoEstoqueRequestDto;
use App\Packages\Produto\ProdutoFacade;
use App\Packages\Produto\Request\ProdutoEstoqueRequest;
use App\Packages\Produto\Response\ProdutoHistoricoMovimentoResponse;

class ProdutoEstoqueController extends Controller
{
    private ProdutoFacade $produtoFacade;

    public function __construct(ProdutoFacade $produtoFacade)
    {
        $this->produtoFacade = $produtoFacade;
    }

    public function adicionarProdutoNoEstoque(Produto $produto, ProdutoEstoqueRequest $request)
    {
        try {
            $this->produtoFacade->adicionarProdutoEstoque($produto, ProdutoEstoqueRequestDto::fromRequest($request));
            return response()->json((new NoContentResponse())->createResponse(false, "Produtos adicionados com sucesso ao estoque"), HttpStatus::OK);
        } catch (\Exception $exception) {
            return response()->json((new ErrorResponse())->createResponse(
                true,
                $exception->getMessage(),
                $exception->getCode()),
                HttpStatus::BAD_REQUEST
            );
        }
    }

    public function baixarProdutoNoEstoque(Produto $produto, ProdutoEstoqueRequest $request)
    {
        try {
            $this->produtoFacade->baixarProdutoNoEstoque($produto, ProdutoEstoqueRequestDto::fromRequest($request));
            return response()->json((new NoContentResponse())->createResponse(false, "Produtos baixados com sucesso do estoque"), HttpStatus::OK);
        } catch (\Exception $exception) {
            return response()->json((new ErrorResponse())->createResponse(
                true,
                $exception->getMessage(),
                $exception->getCode()),
                HttpStatus::BAD_REQUEST
            );
        }
    }

    public function obterHistoricoDeMovimentoDoProduto(Produto $produto)
    {
        try {
            return response()->json((new ProdutoHistoricoMovimentoResponse($produto))->createResponse(false), HttpStatus::OK);
        } catch (\Exception $exception) {
            return response()->json((new ErrorResponse())->createResponse(
                true,
                $exception->getMessage(),
                $exception->getCode()),
                HttpStatus::BAD_REQUEST
            );
        }
    }
}

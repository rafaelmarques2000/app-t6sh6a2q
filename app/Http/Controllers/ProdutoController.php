<?php

namespace App\Http\Controllers;

use App\Packages\Base\HttpStatus;
use App\Packages\Base\Response\ErrorResponse;
use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Dto\ProdutoRequestDto;
use App\Packages\Produto\ProdutoFacade;
use App\Packages\Produto\Request\ProdutoRequest;
use App\Packages\Produto\Response\ProdutoListResponse;
use App\Packages\Produto\Response\ProdutoResponse;

class ProdutoController extends Controller
{
    private ProdutoFacade $produtoFacade;

    public function __construct(ProdutoFacade $produtoFacade)
    {
        $this->produtoFacade = $produtoFacade;
    }

    public function index()
    {
        try {
            $listaDeProdutos = $this->produtoFacade->getAll();
            return response()->json((new ProdutoListResponse($listaDeProdutos))->createResponse(false), HttpStatus::OK);
        } catch (\Exception $exception) {
            return response()->json((new ErrorResponse())->createResponse(
                true,
                $exception->getMessage(),
                $exception->getCode()),
                HttpStatus::BAD_REQUEST
            );
        }
    }

    public function show(Produto $produto)
    {
        try {
            return response()->json((new ProdutoResponse($produto))->createResponse(false), HttpStatus::OK);
        } catch (\Exception $exception) {
            return response()->json((new ErrorResponse())->createResponse(
                true,
                $exception->getMessage(),
                $exception->getCode()),
                HttpStatus::BAD_REQUEST
            );
        }
    }

    public function store(ProdutoRequest $request)
    {
        try {
            $produto = $this->produtoFacade->create(ProdutoRequestDto::fromRequest($request));
            return response()->json((new ProdutoResponse($produto))->createResponse(false), HttpStatus::CREATED);
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

<?php

namespace App\Packages\Produto\Domain\Repository;

use App\Packages\Produto\Domain\Model\Produto;
use Illuminate\Support\Collection;

interface ProdutoRepositoryInterface
{
    public function getAll(): Collection;

    public function getBySku(string $sku): ?Produto;

    public function create(Produto $produto): Produto;

    public function update(Produto $produto): Produto;

    public function delete(Produto $produto): Produto;
}

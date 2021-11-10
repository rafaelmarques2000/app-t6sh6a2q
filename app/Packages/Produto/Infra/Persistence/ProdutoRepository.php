<?php

namespace App\Packages\Produto\Infra\Persistence;

use App\Packages\Doctrine\Repository\Repository;
use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Domain\Repository\ProdutoRepositoryInterface;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ProdutoRepository extends Repository implements ProdutoRepositoryInterface
{
    protected string $entityName = Produto::class;

    public function getAll(): Collection
    {
        return collect($this->findAll());
    }

    public function getById(string $id): ?Produto
    {
        return $this->find($id);
    }

    public function create(Produto $produto): Produto
    {
        $this->dbSave($produto);
        EntityManager::flush();
        return $produto;
    }

    public function update(Produto $produto): Produto
    {
        $this->dbUpdate($produto);
        EntityManager::flush();
        return $produto;
    }

    public function getBySku(string $sku): ?Produto
    {
        return $this->findOneBy(['sku' => $sku]);
    }
}

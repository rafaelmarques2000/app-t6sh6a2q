<?php

namespace Database\Seeders;

use App\Packages\Produto\Domain\Model\Produto;
use App\Packages\Produto\Domain\Repository\ProdutoRepositoryInterface;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = [
            [
                'sku' => "BR/500",
                'nome' => "Sansung Galaxy S20",
                'quantidadeInicial' => 1000
            ],
            [
                'sku' => "BR/100",
                'nome' => "Iphone X 128GB",
                'quantidadeInicial' => 1000
            ],
            [
                'sku' => "BR/100",
                'nome' => "Xiaomi N9 128GB",
                'quantidadeInicial' => 1000
            ]
        ];

        /** @var ProdutoRepositoryInterface $produtoRepository */
        $produtoRepository = app(ProdutoRepositoryInterface::class);

        if ($produtoRepository->getAll()->isEmpty()) {
            foreach ($produtos as $produto) {
                EntityManager::persist(new Produto($produto['sku'], $produto['nome'], $produto['quantidadeInicial']));
            }
            EntityManager::flush();
        }
    }
}

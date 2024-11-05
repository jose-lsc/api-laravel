<?php 

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Produto;
use App\Models\CategoriaProduto;

use Exception;

class ProdutoService {
    public function createProduto(array $dto):Produto | Exception
    {
        try {
            DB::beginTransaction();
                $produto = Produto::create([
                    'nome' => $dto['nome'],
                    'preco' => $dto['preco'],
                    'quantidade_estoque' => $dto['quantidade_estoque'],
                    'marca' => $dto['marca'],
                    'descricao' => $dto['descricao'],
                ]);

                foreach($dto['categoria_ids'] as $categoriaId){
                    CategoriaProduto::updateOrCreate([
                        'produto_id' => $produto->id,
                        'categoria_id' => $categoriaId
                    ],[
                        'produto_id' => $produto->id,
                        'categoria_id' => $categoriaId
                    ]);
                }
            DB::commit();
            return $produto;
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception($e->getMessage());
        }
    }

    public function listTodosProdutos():Collection
    {
        return Produto::get();
    }

    public function listProdutosFiltro(
        string|null $produtoNome = null,
        string|null $categoria = null,
        string|null $marca = null,
        float|null $precoMin = null,
        float|null $precoMax = null
    ): Collection {
        return Produto::with("categoriasProdutos.categoria")
            ->when($produtoNome, function ($query) use ($produtoNome) {
                $query->where("nome", "ilike", "%" . $produtoNome . "%");
            })
            ->when($categoria, function ($query) use ($categoria) {
                $query->whereHas("categoriasProdutos.categoria", function ($query) use ($categoria) {
                    $query->where("nome", "ilike", "%" . $categoria . "%");
                });
            })
            ->when($marca, function ($query) use ($marca) {
                $query->where("marca", "ilike", "%" . $marca . "%");
            })
            ->when($precoMin, function ($query) use ($precoMin) {
                $query->where("preco", ">=", $precoMin);
            })
            ->when($precoMax, function ($query) use ($precoMax) {
                $query->where("preco", "<=", $precoMax);
            })
            ->get();
    }
}
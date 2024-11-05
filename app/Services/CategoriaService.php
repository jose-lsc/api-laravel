<?php 

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

use Exception;

use Illuminate\Database\Eloquent\Collection;


class CategoriaService {
    public function createCategoria(array $dto):Categoria | Exception {
        try {
            DB::begintransaction();
                $categoria = Categoria::create($dto);
            DB::commit();
            return $categoria;
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception($e->getMessage());
        }
    }
}
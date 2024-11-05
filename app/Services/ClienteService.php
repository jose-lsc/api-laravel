<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Cliente;

use Exception;

use Illuminate\Database\Eloquent\Collection;

class ClienteService {
    public function createCliente(array $dto): Cliente | Exception {
        try {
            DB::beginTransaction();
                $cliente = Cliente::create($dto);
            DB::commit();
            return $cliente;
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception($e->getMessage());
        }
    }

    public function listCliente():Collection {
        return Cliente::get();
    }
}
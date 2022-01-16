<?php

namespace App\Http\Repositories\Contracts;

interface BaseRepositoryInterface {

    public function all();

    public function getById($id);

    public function create(array $payload);

    public function update(array $payload, int $id);

    public function delete($id);
}
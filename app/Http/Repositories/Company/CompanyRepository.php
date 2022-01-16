<?php

namespace App\Http\Repositories\Company;

use App\Http\Repositories\Contracts\BaseRepositoryInterface;
use App\Models\Company\Company;

class CompanyRepository implements BaseRepositoryInterface {

    protected $company;

    public function __construct(Company $company)
    {
        return $this->company = $company;
    }

    public function all() {
        return $this->company->where('user_id', auth()->user()->id)->paginate(10);
    }

    public function getById($id) {
        return $this->company->where('id', $id)->first();
    }

    public function create(array $data) {
        return $this->company->create($data);
    }

    public function update(array $data, int $id) {
        $company = $this->company->where('id', $id)->first();

        return $company->fill($data)->save();
    }

    public function delete($id) {
        $company = $this->company->where('id', $id)->first();

        return $company->delete();
    }
}
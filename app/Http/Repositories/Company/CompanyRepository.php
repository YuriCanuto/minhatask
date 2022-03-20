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

       return $this->company->where('uuid', $id)->first();      

    }

    public function create(array $data) {
        try {
            $result = $this->company->create($data);
        } catch (\Exception $e) {
            \Log::error("Message: {$e->getMessage()}");
        }
        return $result;
    }

    public function update(array $data, string $id) {

        try {
            $company = $this->company->where('uuid', $id)->first();

            $company->fill($data)->save();
        } catch (\Exception $e) {
            \Log::error("Message: {$e->getMessage()}");
        }
        

        return $company;
    }

    public function delete($id) {

        try {
            $company = $this->company->where('uuid', $id)->first();
            $company->delete();
        } catch (\Exception $e) {
            \Log::error("Message: {$e->getMessage()}");
        }

        return $company;
    }
}
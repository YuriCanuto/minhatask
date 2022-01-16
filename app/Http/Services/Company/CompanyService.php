<?php

namespace App\Http\Services\Company;

use App\Http\Repositories\Company\CompanyRepository;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\Company\CreateCompanyResource;

class CompanyService {

    protected $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        $result = $this->repository->all();

        return CompanyResource::collection($result)->response()->getData();
    }

    public function create(array $data)
    {
        $company = $this->repository->create($data);

        return new CreateCompanyResource($company);
    }

}
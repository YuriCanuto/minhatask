<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\Company\CompanyCollection;
use App\Http\Resources\Company\CreateCompanyResource;
use App\Http\Services\Company\CompanyService;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class CompanyController extends Controller
{
    private $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->service->list(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {   
        $company = $this->service->create($request->validated());
        
        return response()->json($company, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        if (!Uuid::isValid($id)) {
            return response()->json([
                'message' => "Not Found",
                'errors' => "Request Not Found",
            ], Response::HTTP_NOT_FOUND);
        }
        
        $company = $this->service->show($id);

        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        if (!Uuid::isValid($id)) {
            return response()->json([
                'message' => "Not Found",
                'errors' => "Request Not Found",
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

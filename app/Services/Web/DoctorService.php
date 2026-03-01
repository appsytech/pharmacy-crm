<?php

namespace App\Services\Web;

use App\Models\Doctor;
use App\Repositories\Web\Interfaces\DoctorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DoctorService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DoctorRepositoryInterface $doctorRepo
    ) {
        //
    }


    /* ============================================================================
    |   Fetch a single Doctor record by its primary ID.
    ==============================================================================*/
    public function find(string $encryptedId, ?array $selectedColumns = null): ?Doctor
    {
        $id =  (int) decrypt($encryptedId);

        return $this->doctorRepo->find($id, $selectedColumns);
    }


    /* ============================================================================
    |  Fetch doctor Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctorsCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->doctorRepo->getDoctorsCollection($filterData, $selectedcolumns);
    }
}

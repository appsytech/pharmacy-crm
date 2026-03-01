<?php

namespace App\Repositories\Web\Interfaces;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

interface DoctorRepositoryInterface
{

 /* ============================================================================
    |   Fetch a single doctor record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Doctor;


     /* ============================================================================
    |  Fetch doctor Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctorsCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

}

<?php

namespace App\Repositories;

use App\Models\Employee;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Interface EmployeeRepository.
 *
 * @package namespace App\Repositories;
 */
class EmployeeRepository extends BaseRepository
{
    public function model(): string
    {
        return Employee::class;
    }
}

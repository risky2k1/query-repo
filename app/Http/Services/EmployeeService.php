<?php


namespace App\Http\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $employee)
    {
        return $this->repository->create($employee);
    }

    public function update(array $employee, $employee_id)
    {
        return $this->repository->update($employee, $employee_id);
    }

    public function delete($employee_id)
    {
        return $this->repository->delete($employee_id);
    }

    public function getById($employee_id)
    {
        return $this->repository->find($employee_id);
    }

    public function getAll()
    {
        return $this->repository->all();
    }
}

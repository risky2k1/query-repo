<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
//
//use App\Http\Requests;
//use Illuminate\Http\Response;
//use Prettus\Repository\Exceptions\RepositoryException;
//use Prettus\Validator\Contracts\ValidatorInterface;
//use Prettus\Validator\Exceptions\ValidatorException;
//use App\Http\Requests\EmployeeCreateRequest;
//use App\Http\Requests\EmployeeUpdateRequest;
//use App\Repositories\EmployeeRepository;
//use App\Validators\EmployeeValidator;
//
///**
// * Class EmployeesController.
// *
// * @package namespace App\Http\Controllers;
// */
//class EmployeesController extends Controller
//{
//    /**
//     * @var EmployeeRepository
//     */
//    protected EmployeeRepository $repository;
//
//    /**
//     * @var EmployeeValidator
//     */
//    protected EmployeeValidator $validator;
//
//    /**
//     * EmployeesController constructor.
//     *
//     * @param EmployeeRepository $repository
//     * @param EmployeeValidator $validator
//     */
//    public function __construct(EmployeeRepository $repository, EmployeeValidator $validator)
//    {
//        $this->repository = $repository;
//        $this->validator  = $validator;
//    }
//
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
//     * @throws RepositoryException
//     */
//    public function index()
//    {
//        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
//        $employees = $this->repository->all();
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $employees,
//            ]);
//        }
//
//        return view('employees.index', compact('employees'));
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  EmployeeCreateRequest $request
//     *
//     * @return Response
//     *
//     * @throws ValidatorException
//     */
//    public function store(EmployeeCreateRequest $request)
//    {
//        try {
//
//            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
//
//            $employee = $this->repository->create($request->all());
//
//            $response = [
//                'message' => 'Employee created.',
//                'data'    => $employee->toArray(),
//            ];
//
//            if ($request->wantsJson()) {
//
//                return response()->json($response);
//            }
//
//            return redirect()->back()->with('message', $response['message']);
//        } catch (ValidatorException $e) {
//            if ($request->wantsJson()) {
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ]);
//            }
//
//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
//        }
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function show($id)
//    {
//        $employee = $this->repository->find($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $employee,
//            ]);
//        }
//
//        return view('employees.show', compact('employee'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function edit($id)
//    {
//        $employee = $this->repository->find($id);
//
//        return view('employees.edit', compact('employee'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  EmployeeUpdateRequest $request
//     * @param  string            $id
//     *
//     * @return Response
//     *
//     * @throws ValidatorException
//     */
//    public function update(EmployeeUpdateRequest $request, $id)
//    {
//        try {
//
//            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
//
//            $employee = $this->repository->update($request->all(), $id);
//
//            $response = [
//                'message' => 'Employee updated.',
//                'data'    => $employee->toArray(),
//            ];
//
//            if ($request->wantsJson()) {
//
//                return response()->json($response);
//            }
//
//            return redirect()->back()->with('message', $response['message']);
//        } catch (ValidatorException $e) {
//
//            if ($request->wantsJson()) {
//
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ]);
//            }
//
//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
//        }
//    }
//
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        $deleted = $this->repository->delete($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'message' => 'Employee deleted.',
//                'deleted' => $deleted,
//            ]);
//        }
//
//        return redirect()->back()->with('message', 'Employee deleted.');
//    }
//}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\EmployeeService;

class EmployeesController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAll();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $this->employeeService->create($request->all());
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employee = $this->employeeService->getById($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $this->employeeService->update($request->all(), $id);
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);
        return redirect()->route('employees.index');
    }
}

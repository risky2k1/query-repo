<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title>Employees</title>
</head>
<body>

<h2>HTML Table</h2>
<a href="{{route('employees.create')}}">Add new Employee</a>
<table>
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($employees as $employee)
        <tr>
            <td>{{$employee->name}}</td>
            <td>{{$employee->gender_name}}</td>
            <td>{{$employee->dob}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->email}}</td>
            <td>
                <a href="{{route('employees.edit',$employee)}}">Edit</a>
                <form action="{{route('employees.destroy',$employee)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">
                        <a>Delete</a>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>

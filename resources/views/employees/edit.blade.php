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
<form action="{{route('employees.update')}}" method="post">
    @csrf
    @method('put')
    Name:
    <label>
        <input type="text" name="name" value="{{$employee->name}}">
    </label>
    <br>
    Gender:
    <label>
        <input type="radio" name="gender" value="0">Nam
        <input type="radio" name="gender" value="1">Nu
    </label>
    <br>
    Date of Birth:
    <label>
        <input type="date" name="date" value="{{$employee->dob}}">
    </label>
    <br>
    Phone:
    <label>
        <input type="number" name="phone" value="{{$employee->phone}}">
    </label>
    <br>
    Email:
    <label>
        <input type="email" name="email" value="{{$employee->email}}">
    </label>
    <br>
    <button type="submit">Update</button>
</form>

</body>
</html>

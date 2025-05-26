<!DOCTYPE html>
<html>
<head>
    <title>Employee Setup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Employee Form</h2>

    <form id="employeeForm">
        <div class="row">
           
            <div class="col-md-4 mb-3">
                <label>Employee UID</label>
                <input type="text" name="Employee_UID" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Employee Name</label>
                <input type="text" name="EmployeeName" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Father's Name</label>
                <input type="text" name="FatherName" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Mother's Name</label>
                <input type="text" name="MotherName" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="DOB" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Gender</label>
                <select name="Gender" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Employee Type</label>
                <select name="Employee_Type_No_FK" class="form-control" required>
                    <option value="">--Select Type--</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->Employee_Type_No_PK }}">{{ $type->Type_Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Designation</label>
                <input type="text" name="Designation" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Contact Number</label>
                <input type="text" name="Contact_Number" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Email Address</label>
                <input type="email" name="Email_Address" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>Remarks</label>
                <textarea name="Remarks" class="form-control"></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="Status" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <hr>
    <h3 class="mt-5 mb-3 text-center">Employee List</h3>
    <table id="employeeTable" class="table table-bordered">
        <thead>
            <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Type</th>
                <th>Contact</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Age</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@include('script')

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Setup</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Employee Setup Form</h2>

    <form id="employeeForm">
        <div class="row">
            <!-- Form Inputs -->
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

        <button type="submit" class="btn btn-primary">Save Employee</button>
    </form>

    <hr>
    <h3 class="mt-5 mb-3">Employee List</h3>
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

<script>
$(document).ready(function () {
    // Initialize DataTable
    const employeeTable = $('#employeeTable').DataTable({
        ajax: '{{ route("employees.list") }}',
        columns: [
            { data: 'Employee_UID' },
            { data: 'Name' },
            { data: 'Designation' },
            { data: 'Employee_Type' },
            { data: 'Contact' },
            { data: 'Email' },
            { data: 'DOB' },
            { data: 'Age' },
            { data: 'Status' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-info editBtn" data-id="${row.Employee_UID}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.Employee_UID}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Handle Form Submission
    $('#employeeForm').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let url = id ? `/employees/${id}/update` : '{{ route("employees.store") }}';

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                $('#employeeForm')[0].reset();
                $('#employeeForm').removeAttr('data-id');
                $('input[name="Employee_UID"]').prop('readonly', false);
                employeeTable.ajax.reload();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                for (let field in errors) {
                    errorMessage += errors[field][0] + '\n';
                }
                alert(errorMessage);
            }
        });
    });

    // Handle Edit
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');

        $.get('/employees/' + id + '/edit', function (data) {
            $('input[name="Employee_UID"]').val(data.Employee_UID).prop('readonly', true);
            $('input[name="EmployeeName"]').val(data.EmployeeName);
            $('input[name="FatherName"]').val(data.FatherName);
            $('input[name="MotherName"]').val(data.MotherName);
            $('input[name="DOB"]').val(data.DOB);
            $('select[name="Gender"]').val(data.Gender);
            $('select[name="Employee_Type_No_FK"]').val(data.Employee_Type_No_FK);
            $('input[name="Designation"]').val(data.Designation);
            $('input[name="Contact_Number"]').val(data.Contact_Number);
            $('input[name="Email_Address"]').val(data.Email_Address);
            $('textarea[name="Remarks"]').val(data.Remarks);
            $('select[name="Status"]').val(data.Status);

            $('#employeeForm').attr('data-id', id);
        });
    });

    // Handle Delete
    $(document).on('click', '.deleteBtn', function () {
        if (!confirm('Are you sure to delete this employee?')) return;

        let id = $(this).data('id');

        $.ajax({
            url: '/employees/' + id + '/delete',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                employeeTable.ajax.reload();
            }
        });
    });
});
</script>
</body>
</html>

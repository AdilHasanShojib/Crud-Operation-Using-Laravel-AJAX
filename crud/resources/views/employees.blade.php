<!DOCTYPE html>
<html>
<head>
    <title>Employee Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Employee Setup Form</h2>

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

        <button type="submit" class="btn btn-primary">Save Employee</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#employeeForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("employees.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#employeeForm')[0].reset();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                for (let field in errors) {
                    errorMessage += errors[field][0] + '\n';
                }
                alert(errorMessage);
            }
        });
    });
</script>
</body>
</html>

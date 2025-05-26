<script>
$(document).ready(function () {
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

    // Submit form (Create or Update)
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

    // Edit
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        $.get(`/employees/${id}/edit`, function (data) {
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

    // Delete
    $(document).on('click', '.deleteBtn', function () {
        if (!confirm('Are you sure to delete this employee?')) return;
        let id = $(this).data('id');

        $.ajax({
            url: `/employees/${id}/delete`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                employeeTable.ajax.reload();
            },
            error: function (xhr) {
                alert('Delete failed');
            }
        });
    });
});
</script>
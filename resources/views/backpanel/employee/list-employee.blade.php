@extends('backpanel.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="col-sm-12 col-md-6">
                <h3 class="card-title">Employees</h3>
            </div>
            <div class="col-sm-12 col-md-6 float-right">
                <a href="{{ route('add-employee') }}"><button type="button"
                        class="btn btn-small bg-gradient-primary float-right">Create Employee</button></a>
            </div>
        </div>


        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if (!empty($employees))
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->empDesignation->designation }}</td>
                                <td>
                                    <a href="{{ route('edit-employee', ['id' => $employee->id]) }}"><i
                                            class="nav-icon fas fa-edit"></i></a>
                                    <a class="delete-emp" href="javascript:void(0)"
                                        data-url="{{ route('delete-employee', ['id' => $employee->id]) }}"><i
                                            class="nav-icon fas fa-trash"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                @endif

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: -1
                }],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example1').on('click', '.delete-emp', function() {
                var url = $(this).attr('data-url');
                if (confirm('Do you want to delete.?')) {
                    window.location.href = url;
                }

            });

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
        });
    </script>
@endsection

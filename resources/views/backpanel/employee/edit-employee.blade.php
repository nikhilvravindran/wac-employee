@extends('backpanel.layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employees</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('list-employee')}}">Employee</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Employee</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="employeeForm" method="post"
                            action="{{ route('update-employee', ['id' => $data['employee']->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                                        value="{{ $data['employee']->name }}" required>
                                    @if ($errors->has('name'))
                                        <span id="error" class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter email" value="{{ $data['employee']->email }}" required>
                                    @if ($errors->has('email'))
                                        <span id="error" class="error">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>

                                    </div>
                                    @if (isset($data['employee']->userImages->image) && !empty($data['employee']->userImages->image))
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3"
                                                src="{{ url('/uploads/images/thumbnail/' . $data['employee']->userImages->image) }}"
                                                alt="Photo">
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select class="form-control select2" name="designation" required>
                                        <option value="">Select</option>
                                        @if (!empty($data['designations']))
                                            @foreach ($data['designations'] as $key => $designation)
                                                <option @if ($designation->id == $data['employee']->designation_id) selected @endif value="{{ $designation->id }}">
                                                    {{ $designation->designation }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('image'))
                                        <span id="error" class="error">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <style>
        #error {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545;
        }

    </style>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#employeeForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    designation: {
                        required: true,
                    },

                },

                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }

            });
        });
    </script>
@endsection

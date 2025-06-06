<!DOCTYPE html>
<html lang="en">

@include('layout.head')

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('layout.navbar')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('layout.left-sidebar')
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Trainers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Trainers</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_trainer"><i
                                    class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">

                        <!-- Stylish Search Bar -->
                        <div class="search-container mb-4">
                            <div class="input-group" style="max-width: 300px; float: right;">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Search trainers...">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="applicantTableBody">
                                    @foreach ($trainers as $trainer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    {{-- <a href="" class="avatar">
                                                        <img alt=""
                                                            src="{{ asset('assets/img/profiles/' . ($trainer->avatar ?? 'default.jpg')) }}">
                                                    </a> --}}
                                                    <a href="">{{ $trainer->first_name }}
                                                        {{ $trainer->last_name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $trainer->phone }}</td>
                                            <td>{{ $trainer->email }}</td>
                                            <td>{{ $trainer->description }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $trainer->status == 'Active' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $trainer->status }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit_trainer_{{ $trainer->id }}">
                                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#evaluateModal{{ $trainer->id }}">
                                                            <i class="fa fa-check-circle m-r-5"></i> Evaluate
                                                        </a> --}}

                                                        {{--
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#delete_trainer_{{ $trainer->id }}"
                                                            data-id="{{ $trainer->id }}"
                                                            data-name="{{ $trainer->first_name }} {{ $trainer->last_name }}">
                                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                                        </a> --}}


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

            @foreach ($trainers as $trainer)
                <div class="modal fade" id="evaluateModal{{ $trainer->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="evaluateModalLabel{{ $trainer->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="evaluateModalLabel{{ $trainer->id }}">Evaluate Trainer
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('performance.trainer.store') }}" method="POST">
                                    @csrf

                                    <h6><strong>Evaluation Form for {{ $trainer->first_name }}
                                            {{ $trainer->last_name }}</strong></h6>
                                    <input type="hidden" name="trainee_id" value="{{ $trainer->employee_id }}">
                                    <div class="row">
                                        <!-- Column 1 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="q1">1. Knowledge of the subject matter</label>
                                                <select class="form-control" name="q1" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q2">2. Clarity in explaining the material</label>
                                                <select class="form-control" name="q2" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q3">3. Engagement and interaction with
                                                    trainees</label>
                                                <select class="form-control" name="q3" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q4">4. Effectiveness in answering questions</label>
                                                <select class="form-control" name="q4" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q5">5. Presentation skills (use of visuals, voice,
                                                    etc.)</label>
                                                <select class="form-control" name="q5" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Column 2 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="q6">6. Ability to keep trainees motivated</label>
                                                <select class="form-control" name="q6" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q7">7. Use of appropriate training methods</label>
                                                <select class="form-control" name="q7" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q8">8. Time management during the training
                                                    session</label>
                                                <select class="form-control" name="q8" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q9">9. Overall communication skills</label>
                                                <select class="form-control" name="q9" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="q10">10. Ability to address individual needs of
                                                    trainees</label>
                                                <select class="form-control" name="q10" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Submit
                                            Evaluation</button>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- Add Trainers List Modal -->
            <div id="add_trainer" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Trainer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('trainers.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Trainer <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="trainer_id" required>
                                                <option value="">-- Select Trainer --</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee['id'] }}">
                                                        {{ $employee['first_name'] }} {{ $employee['last_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Role Field -->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="role"
                                                value="Trainer">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="description" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- /Add Trainers List Modal -->

            <!-- Edit Trainers List Modal -->
            @foreach ($trainers as $trainer)
                <div id="edit_trainer_{{ $trainer->id }}" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Trainer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('trainers.update', $trainer->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">First Name <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="first_name"
                                                    value="{{ $trainer->first_name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Last Name</label>
                                                <input class="form-control" type="text" name="last_name"
                                                    value="{{ $trainer->last_name }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Role <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="role"
                                                    value="{{ $trainer->role }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="email" name="email"
                                                    value="{{ $trainer->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Phone</label>
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ $trainer->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="Active"
                                                        {{ $trainer->status == 'Active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="Inactive"
                                                        {{ $trainer->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="4" name="description" required>{{ $trainer->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- /Edit Trainers List Modal -->

            <!-- Delete Trainers List Modal -->
            @foreach ($trainers as $trainer)
                <div id="delete_trainer_{{ $trainer->id }}" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Trainer</h3>
                                    <p>Are you sure you want to delete <strong>{{ $trainer->first_name }}
                                            {{ $trainer->last_name }}</strong>?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('trainers.destroy', $trainer->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-lg w-100">Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-dismiss="modal"
                                                class="btn btn-secondary btn-lg w-100">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <!-- /Delete Trainers List Modal -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let typingTimer;
        $("#searchInput").on("keyup", function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                var value = $("#searchInput").val().toLowerCase();
                $("#applicantTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            }, 200); // delay in ms
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Try Again'
                });
            @endif
        });
    </script>

    <!-- jQuery -->


    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Datatable JS -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <!-- Select2 JS -->
    <script src="assets/js/select2.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>

</body>

</html>

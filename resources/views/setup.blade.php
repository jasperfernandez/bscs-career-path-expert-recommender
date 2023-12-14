<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/img/jflogo.png">
    <title>Admin Dashboard</title>
    {{--  Bootstrap --}}
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    {{-- FontAwesome --}}
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    {{-- Select2 --}}
    <link href="/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    {{-- DataTables --}}
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="h1 text-center pt-4"><b>BSCS CAREER PATH ADMIN DASHBOARD</b> </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">BSCS Career Attachment Form</h6>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('career-attach') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="career-name" class="form-label">Career Name</label>
                                <select class="career-name form-control" name="career-name" id="career-name">
                                    <option value="">Select</option>
                                    @foreach ($bscsCareers as $career)
                                        <option value="{{ $career->id }}">{{ $career->bscs_career_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="extra-curricular-activities" class="form-label">Extra Curricular
                                    Activities</label>
                                <select class="extra-curricular-activities form-control"
                                    name="extra-curricular-activities[]" id="extra-curricular-activities"
                                    multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($extraCurricularActivities as $activity)
                                        <option value="{{ $activity->id }}">
                                            {{ $activity->extra_curricular_activity_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="interests" class="form-label">Interests</label>
                                <select class="interests form-control" name="interests[]" id="interests"
                                    multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($interests as $interest)
                                        <option value="{{ $interest->id }}">{{ $interest->interest_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">BSCS Career Records</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Career Name</th>
                                    <th>Extra Curricular Activities</th>
                                    <th>Interests</th>
                                    <th>Difficulty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bscsCareersWithRelatedData as $career)
                                    <tr>
                                        <td>{{ $career->id }}</td>
                                        <td>{{ $career->bscs_career_name }}</td>
                                        <td>
                                            @if ($career->extraCurricularActivities->isNotEmpty())
                                                @foreach ($career->extraCurricularActivities as $activity)
                                                    {{ $activity->extra_curricular_activity_name }},
                                                @endforeach
                                            @else
                                                No activities
                                            @endif
                                        </td>
                                        <td>
                                            @if ($career->interests->isNotEmpty())
                                                @foreach ($career->interests as $interest)
                                                    {{ $interest->interest_name }},
                                                @endforeach
                                            @else
                                                No interests
                                            @endif
                                        </td>
                                        <td>{{ $career->difficulty }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Bootstrap --}}
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/chart.js/chart.umd.js"></script>
    {{-- Select2 --}}
    <script src="/vendor/select2/dist/js/select2.min.js"></script>
    {{-- DataTables --}}
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <script src="/js/ruang-admin.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.career-name').select2({
                placeholder: "Select a career",
            });

            $('.extra-curricular-activities').select2({
                placeholder: "Select the extra curricular activities",
            });

            $('.interests').select2({
                placeholder: "Select the interests",
            });

            $('#dataTableHover').DataTable();
        });
    </script>
</body>

</html>

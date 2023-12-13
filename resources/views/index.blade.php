<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/img/jflogo.png">
    <title>Home</title>
    {{--  Bootstrap --}}
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    {{-- FontAwesome --}}
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    {{-- Select2 --}}
    <link href="/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

    <link href="/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="h1 text-center pt-4"><b>BSCS CAREER PATH EXPERT RECOMMENDER SYSTEM</b> </div>
        <div class="row">
            <div class="col-md-8 mx-auto d-flex flex-column">
                <div class="card mb-4">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('create-student') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your full name">
                            </div>

                            <div class="form-group">
                                <label for="academic-performance" class="form-label">Academic Performance</label>
                                <select class="academic-performance form-control" name="academic-performance"
                                    id="academic-performance">
                                    <option value="">Select</option>
                                    @foreach ($academicPerformances as $performance)
                                        <option value="{{ $performance->id }}">
                                            {{ $performance->academic_performance_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="interests" class="form-label">Interests</label>
                                <select class="interests form-control" name="interests[]" multiple="multiple"
                                    id="interests">
                                    <option value="">Select</option>
                                    @foreach ($interests as $interest)
                                        <option value="{{ $interest->id }}">{{ $interest->interest_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="preferred-career" class="form-label">Preferred Career</label>
                                <select class="preferred-career form-control" name="preferred-career"
                                    id="preferred-career">
                                    <option value="">Select</option>
                                    @foreach ($bscsCareers as $career)
                                        <option value="{{ $career->id }}">{{ $career->bscs_career_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="extra-curricular-activities" class="form-label">Extra Curricular
                                    Activites</label>
                                <select class="extra-curricular-activities form-control"
                                    name="extra-curricular-activities[]" multiple="multiple"
                                    id="extra-curricular-activities">
                                    <option value="">Select</option>
                                    @foreach ($extraCurricularActivities as $activity)
                                        <option value="{{ $activity->id }}">
                                            {{ $activity->extra_curricular_activity_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-2">Start</button>
                        </form>
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

    <script src="/js/ruang-admin.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.interests').select2({
                placeholder: "Select a Interests",
            });

            $('.preferred-career').select2({
                placeholder: "Select a Preferred Career",
            });

            $('.academic-performance').select2({
                placeholder: "Select a Academic Performance",
            });

            $('.extra-curricular-activities').select2({
                placeholder: "Select a Extra Curricular Activities",
            });
        });
    </script>

</body>

</html>

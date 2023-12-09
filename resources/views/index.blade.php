<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div class="container">
        <div class="h1 text-center pt-4"><b>BSCS CAREER PATH EXPERT RECOMMENDER SYSTEM</b> </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">User Form</h6>
                    </div>
                    <div class="card-body">


                        <form>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your full name">
                            </div>

                            <div class="form-group">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" class="form-control" id="age" name="age"
                                    placeholder="Enter your age">
                            </div>

                            <div class="form-group">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="gender form-control" name="gender[]" id="gender" multiple="multiple">
                                    <option value="">Select</option>
                                    <option value="F">Female</option>
                                    <option value="M">Male</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="academicPerformance" class="form-label">Academic Performance</label>
                                <select class="academicPerformance form-control" name="ap[]" id="academicPerformance"
                                    multiple="multiple">
                                    <option value="">Select</option>
                                    <option value="0">Outstanding</option>
                                    <option value="1">Excellent</option>
                                    <option value="2">Very Good</option>
                                    <option value="3">Good</option>
                                    <option value="4">Passed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="interests" class="form-label">Interest</label>
                                <select class="interests form-control" name="interest[]" multiple="multiple"
                                    id="interests">
                                    <option value="">Select</option>
                                    <option value="0">Programming</option>
                                    <option value="1">Graphic Design</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="preferredCareer" class="form-label">Preferred Career</label>
                                <select class="preferredCareer form-control" name="pc[]" id="preferredCareer"
                                    multiple="multiple">
                                    <option value="">Select</option>
                                    <option value="0">Game Developer</option>
                                    <option value="1">Web Developer</option>
                                    <option value="2">Full Stack Developer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="extraCurricularActivities" class="form-label">Extra Curricular
                                    Activites</label>
                                <select class="extraCurricularActivities form-control" name="eca[]"
                                    multiple="multiple" id="extraCurricularActivities">
                                    <option value="">Select</option>
                                    <option value="0">Hackathon</option>
                                    <option value="1">Pitching</option>
                                    <option value="2">IT Lympics</option>
                                    <option value="3">Technofair</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Start</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4" style="height: 731.8px;">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Recommendations</h6>
                    </div>
                    <div class="card-body">
                        <p>Preferred Career: <span><b>Backend Developer</b></span></p>
                        <p>Recommended Career: <span><b>Full Stack Developer</b></span></p><br><br>
                        <!-- Radar Chart -->
                        <canvas id="radarChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#radarChart'), {
                                    type: 'radar',
                                    data: {
                                        labels: [
                                            'Technical',
                                            'Logical',
                                            'Mathematical',
                                            'Design',
                                            'Business',
                                            'General',
                                            'Communication'
                                        ],
                                        datasets: [{
                                            label: 'Jasper Fernandez',
                                            data: [96, 88, 81, 89, 96, 37, 89],
                                            fill: true,
                                            backgroundColor: 'rgba(103, 119, 239, 0.2)',
                                            borderColor: 'rgb(103, 119, 239)',
                                            pointBackgroundColor: 'rgb(103, 119, 239)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(103, 119, 239)'
                                        }]
                                    },
                                    options: {
                                        elements: {
                                            line: {
                                                borderWidth: 3
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Radar CHart -->
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

            var interests = [{
                    id: 0,
                    text: 'enhancement'
                },
                {
                    id: 1,
                    text: 'bug'
                },
                {
                    id: 2,
                    text: 'duplicate'
                },
                {
                    id: 3,
                    text: 'invalid'
                },
                {
                    id: 4,
                    text: 'wontfix'
                }
            ];

            $('.gender').select2({
                placeholder: "Select a Gender",
                maximumSelectionLength: 1,
                // data: data,
                // allowClear: true
            });

            $('.interests').select2({
                placeholder: "Select a Interests",
            });

            $('.preferredCareer').select2({
                placeholder: "Select a Preferred Career",
                maximumSelectionLength: 1,
            });

            $('.academicPerformance').select2({
                placeholder: "Select a Academic Performance",
                maximumSelectionLength: 1,
            });

            $('.extraCurricularActivities').select2({
                placeholder: "Select a Extra Curricular Activities",
            });
        });
    </script>

</body>

</html>

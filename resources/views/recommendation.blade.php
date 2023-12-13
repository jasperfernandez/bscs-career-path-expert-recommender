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
        <div class="h1 text-center pt-4"><b>RESULTS</b> </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <p>Student Name: <span><b>{{ $studentName }}</b></span></p>
                        <p>Academic Performance: <span><b>{{ $studentAcademicPerformance }}</b></span></p>
                        <p>Preferred Career: <span><b>{{ $studentPreferredCareer }}</b></span></p>
                        <p>Recommended Career: <span><b>{{ $bestMatchedCareer->bscs_career_name }}</b></span></p>

                        <!-- Radar Chart -->
                        <canvas id="radarChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let dataLabels = @json($skillNames);
                                let datasetsLabel = @json($studentName);
                                let data = @json($skillPointsData);

                                new Chart(document.querySelector('#radarChart'), {
                                    type: 'radar',
                                    data: {
                                        labels: dataLabels,
                                        datasets: [{
                                            label: datasetsLabel,
                                            data: data,
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
                                                borderWidth: 2
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

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/img/jflogo.png">
    <title>Recommendation Results</title>
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
        <div class="h1 text-center pt-4"><b>RECOMMENDATION RESULTS</b> </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>Student Name: <span><b>{{ $studentName }}</b></span></p>
                                <p>Academic Performance: <span><b>{{ $studentAcademicPerformance }}</b></span></p>
                                <p>Student Preferred Career: <span><b>{{ $studentPreferredCareer }}</b></span></p>
                                <p>Recommended Career:
                                    @foreach ($careersWithHighestScore as $recommendedCareer)
                                        <span><b>{{ $recommendedCareer->bscs_career_name }}</b></span>,
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-6">
                                <p>Student Extra Curricular Activities:
                                    @foreach ($studentExtraCurricularActivities as $activity)
                                        <span><b>{{ $activity }}</b></span>,
                                    @endforeach
                                </p>
                                <p>Student Interests:
                                    @foreach ($studentInterests as $interest)
                                        <span><b>{{ $interest }}</b></span>,
                                    @endforeach
                                </p>
                            </div>
                        </div>

                        <!-- Radar Chart -->
                        <canvas id="radarChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let fordatasetLabel1 = @json($datasetLabel1);
                                let fordatasetLabel2 = @json($datasetLabel2);
                                let datasetsLabel = @json($skillNames);
                                let data = @json($skillPointsData1);
                                let data2 = @json($skillPointsData2);

                                new Chart(document.querySelector('#radarChart'), {
                                    type: 'radar',
                                    data: {
                                        labels: datasetsLabel,
                                        datasets: [{
                                            label: fordatasetLabel1,
                                            data: data,
                                            fill: true,
                                            backgroundColor: 'rgba(103, 119, 239, 0.2)',
                                            borderColor: 'rgb(103, 119, 239)',
                                            pointBackgroundColor: 'rgb(103, 119, 239)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(103, 119, 239)'
                                        }, {
                                            label: fordatasetLabel2,
                                            data: data2,
                                            fill: true,
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            pointBackgroundColor: 'rgb(255, 99, 132)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(255, 99, 132)'
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            r: {
                                                angleLines: {
                                                    display: false
                                                },
                                                suggestedMin: 0,
                                                suggestedMax: 10,
                                            }
                                        },
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

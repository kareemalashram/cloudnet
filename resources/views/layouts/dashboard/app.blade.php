
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Dashboard | NetSky</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--jquery -->
    <script src="{{asset('dashboard_files/js/jquery-3.3.1.min.js')}}"></script>

    <!-- noty -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>

    // select2
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/select2/select2.min.css')}}">



    {{--<link href="{{asset('dashboard_files/noty/noty.css')}}" rel="stylesheet">--}}
    {{--<script src="{{asset('dashboard_files/noty/noty.js')}}" type="text/javascript"></script>--}}


    <style>
        label {font-weight: bold}
    </style>

    @stack('style')
</head>
<body class="app sidebar-mini">

@include('layouts.dashboard._header')

@include('layouts.dashboard._aside')

<main class="app-content" style="margin-top: 30px;">


    @include('partials._session')
    @yield('content')



</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
// select2
<script src="{{asset('dashboard_files/select2/select2.min.js')}}"></script>
//movie js
<script src="{{asset('dashboard_files/js/custom/movie.js')}}"></script>

<script src="{{asset('dashboard_files/js/main.js')}}"></script>
<script type="text/javascript">
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86]
            }
        ]
    };
    var pdata = [
        {
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: 50,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<script>

    //ajaxSetup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //delete
    $('.delete').click(function (e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({

            text: "confirm_delete",
            type: "warning",
            killer: true,
            buttons: [

                Noty.button("Yes",'btn btn-success mr-2',function () {

                    that.closest('form').submit();

                }),

                Noty.button("No",'btn btn-primary mr-2',function () {

                    n.close();

                })

            ]
        });
        n.show();
    });

    //select2
    $('.select2').select2({
        width: '100%'
    });

    // image preview

    $(".image").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });

    $(".image2").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview2').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });

</script>

</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.title', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .headline {
            font-size: 24px;
        }

        .desc {
            font-size: 24px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

    <style>
        .table-responsive {
            border:1px solid #aaa;
        }
        table {
            width: 100%;
        }
        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        tbody {
            display: block;
            overflow-y: auto;
            table-layout: fixed;
            max-height: 70vh;
        }

        tbody::-webkit-scrollbar {
            display: none;
        }

        table thead {
            border-top: none;
            border-bottom: none;
            background-color: #FFF;
        }
        tbody{
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .color-1>td{background-color: #1d4877; color:#eee;}
        .color-2>td{background-color: #1b8a5a; color:#eee;}
        .color-3>td{background-color: #fbb021;}
        .color-4>td{background-color: #f68838;}
        .color-5>td{background-color: #ee3e32; color:#eee;}

        tr>td{
            cursor: default;
        }
        
        tr:hover>td{
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            <a href="/">home</a>
            @auth
                <a href="{{ route('home') }}">Control Panel</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th><a href="/timeline">Developer (Skill)</a></th>
                <th><a href="/timeline?sort=task_id">Task Title (Level)</a></th>
                <th><a href="/timeline?sort=week_number">Week Number</a></th>
                <th><a href="/timeline?sort=start">Start</a></th>
                <th><a href="/timeline?sort=duration">Duration</a></th>
            </tr>
            </thead>
            <tbody>
            @foreach($times as $time)
                <tr class="color-{{$time->task->level}}">
                    <td>{{$time->developer->title}} ({{$time->developer->level}}x)</td>
                    <td>{{$time->task->name}} ({{$time->task->level}}x)</td>
                    <td>{{$time->week_number}}</td>
                    <td>{{$time->start}}</td>
                    <td>{{$time->duration}} hour{{$time->duration>1?'s':''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Gantt/1.1.0/js/jquery.fn.gantt.min.js"></script>
<script>
    var today = moment();
    var andTwoHours = moment().add(2, "hours");

    var today_friendly = "/Date(" + today.valueOf() + ")/";
    var next_friendly = "/Date(" + andTwoHours.valueOf() + ")/";

    $("#myTimeline").gantt({
        source: [{
            name: "Testing",
            desc: " ",
            values: [{
                from: today_friendly,
                to: next_friendly,
                label: "Test",
                customClass: "ganttRed"
            }]
        }],
        scale: "weeks",
        minScale: "weeks",
        maxScale: "months",
        onItemClick: function(data) {
            alert("Item clicked - show some details");
        },
        onAddClick: function(dt, rowId) {
            alert("Empty space clicked - add an item!");
        },
        onRender: function() {
            console.log("chart rendered");
        }
    });
</script>
--}}
</body>
</html>

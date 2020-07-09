@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>SISINFRA</title>

    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <style type="text/css">
        #mynetwork {
            width: 600px;
            height: 400px;
            border: 1px solid lightgray;
            margin: 0 auto;
        }
    </style>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'SISINFRA'])
    <body>

    <div id="mynetwork"></div>
    <script type="text/javascript">

        var nodes = null;
        var edges = null;
        var network = null;

        var DIR = "../img/icon/";
        var EDGE_LENGTH_MAIN = 150;
        var EDGE_LENGTH_SUB = 50;

        // Called when the Visualization API is loaded.
        function draw() {
            // Create a data table with nodes.
            nodes = [];

            // Create a data table with links.
            edges = [];

            @foreach($service_instance as $si)
                nodes.push({
                    id: "{{$si->id}}",
                    label: "{{$si->descr}}",
                    image: DIR + "icons8-computador-80.png",
                    shape: "image"
                });
            @endforeach

            @foreach($service_dependency as $sd)
                edges.push({ from: "{{$sd->service_instance_id}}", to: "{{$sd->service_instance_id_dep}}"});
            @endforeach

            // create a network
            var container = document.getElementById("mynetwork");
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {};
            network = new vis.Network(container, data, options);
        }

        window.addEventListener("load", () => {
            draw();
        });

        {{--// create an array with nodes--}}
        {{--var nodes = new vis.DataSet([--}}

        {{--    @foreach($service_instance as $si)--}}
        {{--    {id: "{{$si->id}}", label: "{{$si->descr}}"},--}}
        {{--        @endforeach--}}
        {{--    // {id: 1, label: 'Node 1'},--}}
        {{--]);--}}

        {{--// create an array with edges--}}
        {{--var edges = new vis.DataSet([--}}
        {{--        @foreach($service_dependency as $sd)--}}
        {{--            {from: "{{$sd->service_instance_id}}", to: "{{$sd->service_instance_id_dep}}"},--}}
        {{--        @endforeach--}}
        {{--    // {from: 1, to: 2},--}}
        {{--]);--}}

        {{--// create a network--}}
        {{--var container = document.getElementById('mynetwork');--}}
        {{--var data = {--}}
        {{--    nodes: nodes,--}}
        {{--    edges: edges--}}
        {{--};--}}
        {{--var options = {};--}}
        {{--var network = new vis.Network(container, data, options);--}}
    </script>
    </body>

@endsection

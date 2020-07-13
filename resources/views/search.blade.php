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
    <style type="text/css">
        #mynetwork2 {
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

            var buscando = "{{$busca}}";
            @foreach($service_instance as $si)
                if("{{$si->descr}}" === buscando){
                    nodes.push({
                        id: "{{$si->id}}",
                        label: "{{$si->descr}}",
                        image: DIR + "Desktop.png",
                        shape: "image"
                    });
                    var raiz = "{{$si->id}}";
                }
            @endforeach

            function busca(raiz) {
                @foreach($service_dependency as $sd)
                    if ("{{$sd->service_instance_id}}" === raiz){
                        var folha = "{{$sd->service_instance_id_dep}}"
                        @foreach($service_instance as $si)
                            if("{{$si->id}}" === folha){
                                nodes.push({
                                    id: "{{$si->id}}",
                                    label: "{{$si->descr}}",
                                    image: DIR + "Desktop.png",
                                    shape: "image"
                                });
                            }
                        @endforeach
                        busca(folha);
                    }
                @endforeach
            }
            busca(raiz);

            {{--nodes.push({--}}
            {{--    id: "{{$si->id}}",--}}
            {{--    label: "{{$si->descr}}",--}}
            {{--    image: DIR + "Desktop.png",--}}
            {{--    shape: "image"--}}
            {{--});--}}

            @foreach($service_dependency as $sd)
            edges.push({ from: "{{$sd->service_instance_id}}", to: "{{$sd->service_instance_id_dep}}"});
            @endforeach

            // create a network
            var container = document.getElementById("mynetwork");
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {
                edges: {
                    arrows: {
                        to: {
                            enabled: true,
                            scaleFactor: 1,
                            src: undefined,
                            type: "arrow"
                        },
                    }
                }
            };
            network = new vis.Network(container, data, options);
        }

        window.addEventListener("load", () => {
            draw();
        });

    </script>
    </body>

@endsection

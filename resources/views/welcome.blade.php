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
    <br>
    <form method="post" action="{{ route('search') }}">
        @csrf
        <input type="text" class = "form-control col-sm-2" name="pesquisa" placeholder="Pesquisar dispositivo">
        <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
    </form>


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
                    image: DIR + "Desktop.png",
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

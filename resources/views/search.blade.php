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
    <br>
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm"><div id="mynetwork"></div></div>
        <div class="col-sm"><pre id="eventSpan"></pre></div>
    </div>



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
                },
                layout: {
                    hierarchical: {
                        direction: "UD",
                        sortMethod: "directed"
                    }
                }
            };
            network = new vis.Network(container, data, options);

            network.on("click", function(params) {
                params.event = "[original event]";
                nodeid = params.nodes;
                @foreach($service_instance as $sis)
                if(nodeid == "{{$sis->id}}"){
                    document.getElementById("eventSpan").innerHTML =
                        "<h5>Host selecionado:</h5>" + "<a>ID: </a>" + nodeid + "<br><a>Descrição: </a>" + "{{$sis->descr}}";
                }
                @endforeach
            });
        }

        window.addEventListener("load", () => {
            draw();
        });

    </script>
    </body>

@endsection

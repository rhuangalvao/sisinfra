@extends('adminlte::page')
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
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="post" action="{{ route('search') }}">
                    @csrf
                    <input type="text" class = "form-control col-sm" name="pesquisa" placeholder="Pesquisar dispositivo">
                    <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
                </form>
            </div>
            <div class="col-sm"><div id="mynetwork"></div></div>
            <div class="col-sm"><pre id="eventSpan"></pre></div>
        </div>
    </div>
    </body>

    <script defer type="text/javascript">

        var nodes = null;
        var edges = null;
        var network = null;
        var nodeid =null;
        var edgeid=null;
        var to = null;
        var imagem = null;
        var DIR = "../img/icon/";

        function imageMap(hostid) {
            @foreach($host_type as $ht)
            if(hostid === "{{$ht->id}}"){
                return "{{$ht->name}}"
            }
            @endforeach
        }

        // Called when the Visualization API is loaded.
        function draw() {
            // Create a data table with nodes.
            nodes = [];

            // Create a data table with links.
            edges = [];

            var buscando = "{{$busca}}";
            if(buscando){
                @foreach($host as $h)
                if("{{$h->hostname}}" === buscando){
                    imagem = imageMap("{{$h->host_type_id}}");
                    nodes.push({
                        id: "{{$h->id}}",
                        label: "{{$h->hostname}}",
                        //image: DIR + "Desktop.png",
                        image: DIR + imagem +".png",
                        shape: "image"
                    });
                    var raiz = "{{$h->id}}";
                }
                @endforeach

                function busca(raiz) {
                    @foreach($snmp_host_connections as $hc)
                    if ("{{$hc->snmp_host_id}}" === raiz){
                        var folha = "{{$hc->remote_chassisid}}";
                        @foreach($host as $h)
                        if("{{$h->chassis_id}}" === folha){
                            imagem = imageMap("{{$h->host_type_id}}");
                            nodes.push({
                                id: "{{$h->id}}",
                                label: "{{$h->hostname}}",
                                image: DIR + imagem +".png",
                                shape: "image"
                            });
                        }
                        @endforeach
                        busca(folha);
                    }
                    @endforeach
                }
                busca(raiz);
            }else {
                @foreach($host as $h)
                    imagem = imageMap("{{$h->host_type_id}}");
                nodes.push({
                    id: "{{$h->id}}",
                    label: "{{$h->hostname}}",
                    //image: DIR + "Desktop.png",
                    image: DIR + imagem +".png",
                    shape: "image"
                });
                @endforeach
            }

            @foreach($snmp_host_connections as $hc)
                @foreach($host as $h)
            if("{{$hc->remote_chassisid}}" === "{{$h->chassis_id}}"){
                to = "{{$h->id}}";
                edges.push({ id: "{{$hc->id}}",
                    from: "{{$hc->snmp_host_id}}",
                    to: to,
                    length: 250,
                    label: "{{$hc->local_portid}}",
                    font: { align: "top" },
                });
            }
            @endforeach
            @endforeach

            // create a network
            var container = document.getElementById("mynetwork");
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {
                interaction: { hover: false },
                edges: {
                    arrows: "to"
                },

            };
            network = new vis.Network(container, data, options);

            network.on("click", function(params) {
                nodeid = params.nodes;
                @foreach($host as $h)
                if(nodeid == "{{$h->id}}"){
                    document.getElementById("eventSpan").innerHTML =
                        "<h5>Host selecionado:</h5>" +
                        "<a>ID: </a>" + nodeid +
                        "<br><a>Descrição: </a>" + "{{$h->hostname}}" +
                        "<br><a>chassis_id: </a>" + "{{$h->chassis_id}}";
                }
                @endforeach
            });

            network.on("selectEdge", function(params) {
                edgeid = params.edges;
                @foreach($snmp_host_connections as $hc)
                if(edgeid == "{{$hc->id}}"){
                    document.getElementById("eventSpan").innerHTML =
                        "<h5>Edge selecionado:</h5>" + "<a>ID: </a>" + edgeid
                        + "<br><a>From: </a>" + "{{$hc->snmp_host_id}}"
                        + "<br><a>To: </a>" + "{{$hc->remote_chassisid}}"
                }
                @endforeach
            });

        }

        window.addEventListener("load", () => {
            draw();
        });
    </script>

@endsection

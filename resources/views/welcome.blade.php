@extends('adminlte::page')
<head>
    <title>SISINFRA</title>
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <style type="text/css">
        #mynetwork {
            width: 650px;
            height: 500px;
            border: 1px solid lightgray;
            margin: 0 auto;
        }
    </style>
</head>
@section('plugins.Select2', true)
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/pt-BR.js"></script>
<link href="public/vendor/select2/css/select2.css" rel="stylesheet"/>
<link rel="stylesheet" href="public/vendor/select2-bootstrap4-theme/select2-bootstrap4.css">
<script src="public/vendor/select2/js/select2.js"></script>
<script>
    $(document).ready(function(){
        $('.select2ex').select2({
            // minimumInputLength: 2,
        });
    });
</script>
@section('content')
    <div class="row">
        <div class="col-sm">
            <div style="text-align: center;"><img src="{{asset('/img/uepg.png')}}" alt="UEPG" height="100"></div>
        </div>
        <div class="col-sm text-center">
            <h1 class="display-4">SISINFRA</h1>
        </div>
        <div class="col-sm">
            <div style="text-align: center;"><img src="{{asset('/img/nti.png')}}" alt="NTI" height="100"></div>
        </div>
    </div>
    <br>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="post" action="{{ route('search') }}">
                    @csrf
{{--                    <input type="text" class = "form-control col-sm" name="pesquisa" placeholder="Choose a Root Host">--}}
                    <select id="pesquisa" name="pesquisa" class="select2ex form-control">
                        <option disabled value="" selected>Choose a Root Host</option>
                        @foreach($host as $h)
                            <option value={{$h->id}}> {{$h->hostname}} </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>
            </div>
            <div class="col-sm"><div id="mynetwork"></div></div>
            <div class="card" style="width: 14rem;">
                <form method="post" action="{{ route('infos') }}">
                    @csrf
                    <div class="col-sm"><pre id="eventSpan"></pre></div>
                </form>
            </div>
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


        function imageMap(hostid) {     //Procura o tipo do host para imprimir a imagem
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
            if (buscando) {                      //Quando houver busca
                @foreach($host as $h)
                if ("{{$h->id}}" === buscando) {            //Imprime a raiz da busca
                    imagem = imageMap("{{$h->host_type_id}}");
                    nodes.push({
                        id: "{{$h->id}}",
                        label: "{{$h->hostname}}",
                        image: DIR + imagem + ".png",
                        shape: "image"
                    });
                    var raiz = "{{$h->id}}";
                }
                @endforeach
                //Imprime as folhas da busca

                // USando join de Hosts com interfaces e usando connections a parte

                function busca(raiz) {
                    @foreach($host_ifjoin as $join)
                        if ("{{$join->host_id}}" === raiz) {
                            @foreach($host_connection as $hc)
                                if("{{$join->id}}" === "{{$hc->host_interface_id_a}}"){
                                    var folha = "{{$hc->host_interface_id_b}}";
                                }
                            @endforeach
                        }
                    @endforeach
                    @foreach($host_ifjoin as $join)
                        if ("{{$join->id}}" === folha) {
                            folha = "{{$join->host_id}}";
                            imagem = imageMap("{{$join->host_type_id}}");
                            nodes.push({
                                id: "{{$join->host_id}}",
                                label: "{{$join->hostname}}",
                                image: DIR + imagem + ".png",
                                shape: "image"
                            });
                        busca(folha);
                        }
                    @endforeach

                }

                //Usando join de host, interfaces e connections
                {{--function busca(raiz) {--}}
                {{--    @foreach($query as $q)--}}
                {{--    if ("{{$q->host_id}}" === raiz) {--}}
                {{--        var folha = "{{$q->host_interface_id_b}}";--}}
                {{--    @endforeach--}}
                {{--    @foreach($query as $q)--}}
                {{--        if ("{{$q->id}}" === folha) {--}}
                {{--            folha = "{{$q->host_id}}";--}}
                {{--            imagem = imageMap("{{$q->host_type_id}}");--}}
                {{--            nodes.push({--}}
                {{--                id: "{{$q->host_id}}",--}}
                {{--                label: "{{$q->hostname}}",--}}
                {{--                image: DIR + imagem + ".png",--}}
                {{--                shape: "image"--}}
                {{--            });--}}
                {{--        }--}}
                {{--    @endforeach--}}
                {{--    busca(folha);--}}
                {{--    }--}}
                {{--}--}}


                {{--function busca(raiz) {--}}
                {{--    @foreach($host_map as $hm)--}}
                {{--    if ("{{$hm->snmp_host_id}}" === raiz) {--}}
                {{--        var folha = "{{$hm->snmp_host_remote_id}}";--}}
                {{--        @foreach($host as $h)--}}
                {{--        if ("{{$h->id}}" === folha) {--}}
                {{--            imagem = imageMap("{{$h->host_type_id}}");--}}
                {{--            nodes.push({--}}
                {{--                id: "{{$h->id}}",--}}
                {{--                label: "{{$h->hostname}}",--}}
                {{--                image: DIR + imagem + ".png",--}}
                {{--                shape: "image"--}}
                {{--            });--}}
                {{--        }--}}
                {{--        @endforeach--}}
                {{--        busca(folha);--}}
                {{--    }--}}
                {{--    @endforeach--}}
                {{--}--}}



                busca(raiz);
            }else {                                 //Senão houver busca
                @foreach($host as $h)
                    imagem = imageMap("{{$h->host_type_id}}");
                nodes.push({
                    id: "{{$h->id}}",
                    label: "{{$h->hostname}}",
                    // image: DIR + "Desktop.png",
                    image: DIR + imagem + ".png",
                    shape: "image"
                });
                @endforeach
            }

            @foreach($host_connection as $hc)
                portfrom = null;
                @foreach($host_ifjoin as $join)
                    if("{{$hc->host_interface_id_a}}" === "{{$join->id}}"){
                        from = "{{$join->host_id}}";
                        portfrom = "{{$join->portid}}";
                    }
                @endforeach
                @foreach($host_ifjoin as $join)
                    if("{{$hc->host_interface_id_b}}" === "{{$join->id}}"){
                        to = "{{$join->host_id}}";
                        portto = "{{$join->portid}}";
                        edges.push({
                            id: "{{$hc->id}}",
                            from: from,
                            to: to,
                            length: 250,
                            label: portfrom + " -> " + portto,
                            font: {align: "top"},
                        });
                    }
                @endforeach
            @endforeach

{{--            @foreach($host_map as $hm)--}}
{{--                @foreach($host as $h)--}}
{{--                    if ("{{$hm->snmp_host_remote_id}}" === "{{$h->id}}") {--}}
{{--                        to = "{{$h->id}}";--}}
{{--                        edges.push({--}}
{{--                            id: "{{$hm->id}}",--}}
{{--                            from: "{{$hm->snmp_host_id}}",--}}
{{--                            to: to,--}}
{{--                            length: 250,--}}
{{--                            label: "IP da Ligação",--}}
{{--                            font: {align: "top"},--}}
{{--                        });--}}
{{--                    }--}}
{{--                @endforeach--}}
{{--            @endforeach--}}

                // create a network
                var container = document.getElementById("mynetwork");
                var data = {
                    nodes: nodes,
                    edges: edges
                };
                var options = {
                    interaction: {hover: false},
                    edges: {
                        arrows: "to"
                    },

                };
                network = new vis.Network(container, data, options);

                network.on("click", function (params) {
                    nodeid = params.nodes;
                    @foreach($host as $h)
                    if (nodeid == "{{$h->id}}") {
                        document.getElementById("eventSpan").innerHTML =
                            "<h5>Host selected:</h5>" +
                            "<br><a>Hostname: </a>" + "{{$h->hostname}}" +
                            "<br><a>Chassis ID: </a>" + "{{$h->chassis_id}}" +
                            "<br><button type='submit' name='infohost' value='{{$h->id}}' class='btn btn-primary mt-2'>More</button>";
                    }
                    @endforeach
                });

                network.on("selectEdge", function (params) {
                    edgeid = params.edges;
                    @foreach($host_connection as $hc)
                        hostfrom = null;
                        chassisfrom = null;
                        portfrom = null;
                        hostto = null;
                        chassisto = null;
                        portto = null;
                        @foreach($host_ifjoin as $join)
                            if("{{$hc->host_interface_id_a}}" === "{{$join->id}}"){
                                hostfrom = "{{$join->hostname}}";
                                chassisfrom = "{{$join->chassis_id}}";
                                portfrom = "{{$join->portid}}";
                            }
                        @endforeach
                        @foreach($host_ifjoin as $join)
                            if("{{$hc->host_interface_id_b}}" === "{{$join->id}}"){
                                hostto = "{{$join->hostname}}";
                                chassisto = "{{$join->chassis_id}}";
                                portto = "{{$join->portid}}";
                            }
                        @endforeach
                        if (edgeid == "{{$hc->id}}") {
                            document.getElementById("eventSpan").innerHTML =
                                "<h5>Connection:</h5>"
                                + "<br><a>From: </a>"
                                + "<br><a>Hostname: </a>" + hostfrom
                                + "<br><a>Chassis: </a>" + chassisfrom
                                + "<br><a>Port: </a>" + portfrom
                                + "<br><a>To: </a>"
                                + "<br><a>Hostname: </a>" + hostto
                                + "<br><a>Chassis: </a>" + chassisto
                                + "<br><a>Port: </a>" + portto ;
                                {{--+"<br><button type='submit' name='infoconnection' value='{{$hm->id}}' class='btn btn-primary mt-2'>More</button>";--}}

                        }
                    @endforeach
                });
            }

            window.addEventListener("load", () => {
                draw();
            });

    </script>

@endsection
@section('footer')
    @include('footer')
@endsection

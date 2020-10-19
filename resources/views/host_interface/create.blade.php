@extends('adminlte::page')

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
<head>
    <title>Host_interface</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Host_interface</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class ="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('host_interface.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">ID Host: </label>
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ifname">ifname: </label>
                                <input type="text" maxlength="30" class="form-control" name="ifname"/>
                            </div>
                            <div class="form-group">
                                <label for="iftype">iftype:</label>
                                <input type="text" maxlength="30" class="form-control" name="iftype" />
                            </div>
                            <div class="form-group">
                                <label for="ifspeed">ifspeed: </label>
                                <input type="text" maxlength="30" class="form-control" name="ifspeed"/>
                            </div>
                            <div class="form-group">
                                <label for="ifindex">ifindex:</label>
                                <input type="text" maxlength="30" class="form-control" name="ifindex" />
                            </div>
                            <div class="form-group">
                                <label for="ifoperstatus">ifoperstatus: </label>
                                <input type="text" maxlength="30" class="form-control" name="ifoperstatus"/>
                            </div>
                            <div class="form-group">
                                <label for="ifalias">ifalias:</label>
                                <input type="text" maxlength="30" class="form-control" name="ifalias" />
                            </div>
                            <div class="form-group">
                                <label for="portid">portid: </label>
                                <input type="text" maxlength="30" class="form-control" name="portid"/>
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden" name="is_mgmt" value="off">
                                <input type="checkbox" class="form-check-input" name="is_mgmt">
                                <label class="form-check-label" for="is_mgmt">is_mgmt</label>
                            </div>

                            <div class="form-group">
                                <label for="discovery_protocol_id">discovery_protocol: </label>
                                <select id="discovery_protocol_id" name="discovery_protocol_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do discovery_protocol</option>
                                    @foreach($discovery_protocol as $dp)
                                        <option value={{$dp->id}}> {{$dp->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="snmp_host_interface_id">snmp_host_interface: </label>
                                <select id="snmp_host_interface_id" name="snmp_host_interface_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do snmp_host_interface</option>
                                    @foreach($snmp_host_interface as $shi)
                                        <option value={{$shi->id}}> {{$shi->ifname}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar Host_interface</button>
                            <form>
                                <input type="button" class="btn btn-danger" value="Cancelar" onclick="history.back()">
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

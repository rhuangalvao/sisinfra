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
    <title>Host Interface</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit Host Interface</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <div class ="card">
                <div class="card-body">
                    <form method="post" action="{{ route('host_interface.update', $host_interface->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="host_id">Host: </label>
                            <select id="host_id" name="host_id" class="select2ex form-control">
                                @foreach($host as $h)
                                    @if($host_interface->host_id == $h->id)
                                        <option value="{{ $host_interface->host_id }}" selected>{{ $h->hostname }}</option>
                                    @endif
                                @endforeach
                                @foreach($host as $h)
                                    <option value={{$h->id}}> {{$h->hostname}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ifname">Name: </label>
                            <input type="text" maxlength="250" class="form-control" name="ifname" value="{{ $host_interface->ifname }}"/>
                        </div>
                        <div class="form-group">
                            <label for="iftype">Type:</label>
                            <input type="text" maxlength="250" class="form-control" name="iftype" value="{{ $host_interface->iftype }}"/>
                        </div>
                        <div class="form-group">
                            <label for="ifspeed">Speed: </label>
                            <input type="text" maxlength="250" class="form-control" name="ifspeed" value="{{ $host_interface->ifspeed }}"/>
                        </div>
                        <div class="form-group">
                            <label for="ifindex">Index:</label>
                            <input type="text" maxlength="250" class="form-control" name="ifindex" value="{{ $host_interface->ifindex }}"/>
                        </div>
                        <div class="form-group">
                            <label for="ifoperstatus">Oper status: </label>
                            <input type="text" maxlength="250" class="form-control" name="ifoperstatus" value="{{ $host_interface->ifoperstatus }}"/>
                        </div>
                        <div class="form-group">
                            <label for="ifalias">Alias:</label>
                            <input type="text" maxlength="250" class="form-control" name="ifalias" value="{{ $host_interface->ifalias }}"/>
                        </div>
                        <div class="form-group">
                            <label for="portid">Port ID:</label>
                            <input type="text" maxlength="250" class="form-control" name="portid" value="{{ $host_interface->portid }}"/>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="is_mgmt" value="off">
                            <input type="checkbox" class="form-check-input" name="is_mgmt">
                            <label class="form-check-label" for="is_mgmt">Is managementt</label>
                        </div>
                        <div class="form-group">
                            <label for="discovery_protocol_id">Discovery protocol: </label>
                            <select id="discovery_protocol_id" name="discovery_protocol_id" class="select2ex form-control">
                                @foreach($discovery_protocol as $dp)
                                    @if($host_interface->discovery_protocol_id == $dp->id)
                                        <option value="{{ $host_interface->discovery_protocol_id }}" selected>{{ $dp->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($discovery_protocol as $dp)
                                    <option value={{$dp->id}}> {{$dp->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="snmp_host_interface_id">snmp_host_interface: </label>
                            <select id="snmp_host_interface_id" name="snmp_host_interface_id" class="select2ex form-control">
                                @foreach($snmp_host_interface as $shi)
                                    @if($host_interface->snmp_host_interface_id == $shi->id)
                                        <option value="{{ $host_interface->snmp_host_interface_id }}" selected>{{ $shi->ifname }}</option>
                                    @endif
                                @endforeach
                                @foreach($snmp_host_interface as $shi)
                                    <option value={{$shi->id}}> {{$shi->ifname}} </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                        <form>
                            <input type="button" class="btn btn-danger" value="Cancel" onclick="history.back()">
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection

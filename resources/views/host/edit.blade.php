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
    <title>host</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit host</h1>
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
                    <form method="post" action="{{ route('host.update', $hosts->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="os_id">Operating System:</label>
                            <select id="os_id" name="os_id" class="select2ex form-control">
                                @foreach($operating_systems as $os)
                                    @if($hosts->os_id == $os->id)
                                        <option value="{{ $hosts->os_id }}" selected>{{ $os->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($operating_systems as $os)
                                    <option value={{$os->id}}> {{$os->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="host_type_id">Host Type: </label>
                            <select id="host_type_id" name="host_type_id" class="select2ex form-control">
                                @foreach($host_types as $ht)
                                    @if($hosts->host_type_id == $ht->id)
                                        <option value="{{ $hosts->host_type_id }}" selected>{{ $ht->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($host_types as $ht)
                                    <option value={{$ht->id}}> {{$ht->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_id">Status:</label>
                            <select id="status_id" name="status_id" class="select2ex form-control">
                                @foreach($host_status as $hs)
                                    @if($hosts->status_id == $hs->id)
                                        <option value="{{ $hosts->status_id }}" selected>{{ $hs->status }}</option>
                                    @endif
                                @endforeach
                                @foreach($host_status as $hs)
                                    <option value={{$hs->id}}> {{$hs->status}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tag">TAG: </label>
                            <input type="text" maxlength="128" class="form-control" name="tag" value="{{ $hosts->tag }}"/>
                        </div>
                        <div class="form-group">
                            <label for="hostname">Hostname: </label>
                            <input type="text" maxlength="128" class="form-control" name="hostname" value="{{ $hosts->hostname }}"/>
                        </div>
                        <div class="form-group">
                            <label for="domain_suffix">Domain suffix: </label>
                            <input type="text" maxlength="128" class="form-control" name="domain_suffix" value="{{ $hosts->domain_suffix }}"/>
                        </div>
                        <div class="form-group">
                            <label for="descr">Description: </label>
                            <input type="text" class="form-control" name="descr" value="{{ $hosts->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="obs">Obs: </label>
                            <input type="text" class="form-control" name="obs" value="{{ $hosts->obs }}"/>
                        </div>
                        <div class="form-group">
                            <label for="chassis_id">Chassis id: </label>
                            <input type="text" maxlength="128" class="form-control" name="chassis_id" value="{{ $hosts->chassis_id }}"/>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="monitoring" value="off">
                            <input type="checkbox" class="form-check-input" name="monitoring">
                            <label class="form-check-label" for="monitoring">Monitoring</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="enabled" value="off">
                            <input type="checkbox" class="form-check-input" name="enabled">
                            <label class="form-check-label" for="enabled">Enabled</label>
                        </div>
                        <div class="form-group">
                            <label for="serial_number">Serial number: </label>
                            <input type="text" maxlength="128" class="form-control" name="serial_number" value="{{ $hosts->serial_number }}"/>
                        </div>
                        <div class="form-group">
                            <label for="aux_vendor_id">Vendor:</label>
                            <select id="aux_vendor_id" name="aux_vendor_id" class="select2ex form-control">
                                @if($hosts->aux_vendor_id!=null)
                                    @foreach($aux_vendors as $av)
                                        @if($hosts->aux_vendor_id == $av->id)
                                            <option value="{{ $hosts->aux_vendor_id }}" selected>{{ $av->name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected></option>
                                @endif
                                @foreach($aux_vendors as $av)
                                    <option value={{$av->id}}> {{$av->name}} </option>
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

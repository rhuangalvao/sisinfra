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
    <title>Host DNS</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add Host DNS</h1>
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
                        <form method="post" action="{{ route('host_dns.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">Host: </label>
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Host name</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" maxlength="30" class="form-control" name="name"/>
                            </div>
                            <div class="form-group">
                                <label for="version">Version: </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version" id="exampleRadios1" value=4 checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        IPV4
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version" id="exampleRadios2" value=6>
                                    <label class="form-check-label" for="exampleRadios2">
                                        IPV6
                                    </label>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden" name="is_main" value="off">
                                <input type="checkbox" class="form-check-input" name="is_main">
                                <label class="form-check-label" for="is_main">Is main</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Host_dns</button>
                            <form>
                                <input type="button" class="btn btn-danger" value="Cancel" onclick="history.back()">
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection

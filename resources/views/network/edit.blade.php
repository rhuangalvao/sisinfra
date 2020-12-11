@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Network</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit Network</h1>
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
                    <form method="post" action="{{ route('network.update', $network->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="network_type_id">Network type:</label>
                            <select id="network_type_id" name="network_type_id" class="select2ex form-control">
                                @foreach($network_type as $nt)
                                    @if($network->network_type_id == $nt->id)
                                        <option value="{{ $network->network_type_id }}" selected>{{ $nt->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($network_type as $nt)
                                    <option value={{$nt->id}}> {{$nt->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" maxlength="50" class="form-control" name="name" value="{{ $network->name }}"/>
                        </div>
                        <div class="form-group">
                            <label for="descr">Description: </label>
                            <input type="text" class="form-control" name="descr" value="{{ $network->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address: </label>
                            <input type="text" maxlength="50" class="form-control" name="address" value="{{ $network->address }}"/>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="enabled" value="off">
                            <input type="checkbox" class="form-check-input" name="enabled">
                            <label class="form-check-label" for="enabled">Enabled</label>
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

@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host Type</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit Host Type</h1>
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
                    <form method="post" action="{{ route('host_type.update', $host_type->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" maxlength="50" class="form-control" name="name" value="{{ $host_type->name }}"/>
                        </div>
                        <div class="form-group">
                            <label for="tag_prefix">TAG: </label>
                            <input type="text" maxlength="10" class="form-control" name="tag_prefix" value="{{ $host_type->tag_prefix }}"/>
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

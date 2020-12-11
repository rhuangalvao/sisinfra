@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host status</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add Host status</h1>
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
                        <form method="post" action="{{ route('host_status.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <input type="text" maxlength="10" class="form-control" name="status"/>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Host status</button>
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

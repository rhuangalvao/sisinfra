<div class="row">
    <div class="col-sm">
        <div style="text-align: center;"><img src="{{asset('/img/uepg.png')}}" alt="UEPG" height="100"></div>
    </div>
    <div class="col-sm text-center">
        <h1 class="display-4">{{$tituloPagina}}</h1>
    </div>
    <div class="col-sm">
        <div style="text-align: center;"><img src="{{asset('/img/nti.png')}}" alt="NTI" height="100"></div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <a  href="{{ route($variavel.'.create')}}" class="btn btn-primary">New {{$tituloPagina}}</a>
        </div>
        <div class="col-sm">
            <form method="post" action="{{ route($variavel.'.search') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label>
                                Show
                                <select name="entradas">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                entries
                            </label>
                        </div>
                        <div class="col-sm">
                            <input type="text" class = "form-control " name="pesquisa" placeholder="">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm">--}}
{{--            <a  href="{{ route($variavel.'.create')}}" class="btn btn-primary">New {{$tituloPagina}}</a>--}}
{{--        </div>--}}
{{--        <div class="col-sm">--}}
{{--        </div>--}}
{{--        <div class="col-sm">--}}
{{--            <form method="post" action="{{ route($variavel.'.search') }}">--}}
{{--                @csrf--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm">--}}
{{--                            <input type="text" class = "form-control " name="pesquisa" placeholder="Search {{$tituloPagina}}">--}}
{{--                        </div>--}}
{{--                        <div class="col-sm">--}}
{{--                            <button type="submit" class="btn btn-primary">Search</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

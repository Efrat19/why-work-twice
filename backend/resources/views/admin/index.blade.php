@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            {{--<div class="col-md-8">--}}
                        <h3 style="color: white"> what whuld you like to do today?</h3></div>
                        @foreach($links as $tool => $link)
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="heading{{$loop->index}}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link admin-tool" type="button" data-toggle="collapse"
                                                    data-target="#collapse{{$loop->index}}" aria-expanded="{{$link['active']}}" aria-controls="collapse{{$loop->index}}">
                                                <h5>{{$link['label']}}</h5>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{$loop->index}}" class="{{$link['active']? 'collapse show' : 'collapse'}}" aria-labelledby="heading{{$loop->index}}" data-parent="#accordionExample">
                                        <div class="card-body" style="background-color: #747474">
                                            @include( $link['view'] ,$link['viewParameters'] )
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
            {{--</div>--}}
        </div>
@endsection

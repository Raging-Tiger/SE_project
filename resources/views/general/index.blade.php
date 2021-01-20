@extends('layouts.app')

@section('content')

<div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
           
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('/img/Liepu_nams_2.png') }}" alt="" title="House">
              </div>                              
              <div class="carousel-item">
                <img  class="d-block w-100" src="{{ asset('/img/3.jpg') }}" alt="" title="House">
              </div>
                             
              <div class="carousel-item">
                <img  class="d-block w-100" src="{{ asset('/img/4.jpg') }}" alt="" title="House">
              </div>
              <div class="carousel-item">
                <img  class="d-block w-100" src="{{ asset('/img/5.jpg') }}" alt="" title="House">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>

 <br>
    
      @if(!empty($notifications) && $notifications->count())
     
            
           @if(!Auth::guest() && (Auth::user()->isTenant() ||Auth::user()->isAdmin() ))
            <div class="card-deck">
                @php $i = 0; @endphp
               @foreach($notifications as $notification)
                    @php $i++; @endphp

                  <div class="card">
                     
                        <div class="card-body">
                          <h5 class="card-title"><b>{{$notification->header}}</b></h5>
                          <p class="card-text">{{$notification->message}}</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Date: {{$notification->created_at}} Author: {{$notification->user->name}}</small>
                        </div>
                </div>
                @if($i == 3)
                </div> <br> <div class="card-deck">
                @php $i=0; @endphp
                @endif
             <!--  <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h4 class="list-group-item list-group-item-primary">{{$notification->header}}</h4>
                            <div class="card-body">
           
                {{$notification->message}}
                <br>
                Date: <b>{{$notification->created_at}}</b>
                <br>
                Author:  <b>{{$notification->user->name}}</b>
                
                
                            </div>
                        </div>
                </div>
            </div> -->
            @endforeach
            </div>
            @endif
            
            @if(Auth::guest() || Auth::user()->isBlocked() || Auth::user()->isUser())
             <div class="card-deck">
                  @php $j = 0; @endphp
            @foreach($publics as $public)
                  @php $j++; @endphp
                  <div class="card">
                     
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$public->header}}</b></h5>
                          <p class="card-text">{{$public->message}}</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Date: {{$public->created_at}} Author: {{$public->user->name}}</small>
                        </div>
               </div>
                @if($j == 3)
                </div> <br> <div class="card-deck">
                @php $j=0; @endphp
                @endif
            @endforeach
             </div>
            @endif
            
        @else

        @endif
        
@if(!Auth::guest() && (Auth::user()->isTenant() ||Auth::user()->isAdmin() )) 
<br>
{!! $notifications->links() !!}
@endif  

@if(Auth::guest() || Auth::user()->isBlocked() || Auth::user()->isUser())
<br>
{!! $publics->links() !!}
@endif  
    
</div>

@endsection


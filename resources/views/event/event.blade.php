@extends('layouts.app')

@section('css')
<link href="{{ asset('css/event.css') }}" rel="stylesheet">
@endsection

@section('header')
@if(session('flag'))
<br />
  @if(session('flag') == 1)
  <div class="alert alert-success alert-dismissible fade show">
    You've registered your interest in this event!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @elseif(session('flag') == 2)
  <div class="alert alert-danger alert-dismissible fade show">
    You are not authorised to do that....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @elseif(session('flag') == 3)
  <div class="alert alert-success alert-dismissible fade show">
    Event Created!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @elseif(session('flag') == 4)
  <div class="alert alert-success alert-dismissible fade show">
    Event Updated!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @endif
@endif
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-12">
    <br />
    <div class="collapse show" id="collapseImage">
      <div class="row justify-content-center">
        <!-- Image display -->
        <div id="carouselIndicators" class="carousel slide" data-interval="false">
          <ol class="carousel-indicators">
            <!-- Indicators - calculates how many to make and links them -->
            <?php $firstIn = true; ?>
            @for($i = 0; $i < count($imagepaths); $i++)
            @if ($firstIn == true)
            <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
            <?php $firstIn = false ?>
            @else
            <li data-target="#carouselIndicators" data-slide-to="{{ $i }}"></li>
            @endif
            @endfor
          </ol>
          <div class="carousel-inner carousel-format card">

            <!-- adds images to viewer -->
            <?php $first = true; ?>
            @foreach($imagepaths as $path)
            @if ($first == true)
            <div class="carousel-item active">
              <img src="{{ asset($path) }}"/>
            </div>
            <?php $first = false ?>
            @else
            <div class="carousel-item">
              <img src="{{ asset($path) }}"/>
            </div>
            @endif
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <br />
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">Toggle Image</button>
    @guest
    @else
    @if( Auth::user()->id == $event->organiserid)
    <a href="{{ route('updateevent', $event->id) }}" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
    @endif
    @endguest
    <br />

    <!-- Event information -->
    <div class="card">
      <div class="card-header text-center">
        <h3><span class="{{ $event->badge }}">{{ $event->text }}</span></h3>
        <h2>{{ $event->name }}</h2>
      </div>
      <div class="card-body">
        <div class="row equal">
          <div class="col-md-6">
            <h3 class="text-center">Description</h3>
            <pre class="card-text">{{ $event->description }}</pre>
            <hr />
            <h4 class="text-center">Related Events</h4>
            <div class="row justify-content-center">
              @if (empty($relatedEvents))
                <p>No related events</p>
              @else
                @foreach($relatedEvents as $key => $value)
                  <a class="btn btn-outline-cyan waves-effect" href="{{ route('event', $key) }}">{{ $value }}</a>
                @endforeach
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <h3 class="text-center">Additional Info</h3>
            <ul class="list-group list-group-flush text-center">
              <li class="list-group-item"><strong>Category:</strong> {{ $event->category }}</li>
              <li class="list-group-item">
                <h4>When?</h4>
                <strong>Time:</strong> {{ $format['time'] }} <br>
                <strong>Date:</strong> {{ $format['date'] }}
              </li>
              <li class="list-group-item">
                <h4>Where?</h4>
                {{ $event->location }}
              </li>
              <li class="list-group-item">
                <h4>Organiser details</h4>
                <strong>Name:</strong> {{ $organiser->name }} <br>
                <strong>Email:</strong> <a href="mailto:{{ $organiser->email }}">{{ $organiser->email }}</a><br>
                <strong>Phone:</strong> {{ $organiser->phone }}
              </li>
              <li class="list-group-item">
                <p><strong>{{ $event->likeness }} people</strong> are interested in going!</p>
              </li>
              <li class="list-group-item">
                @if ($event->weblink == "" or $event->weblink == null)
                  <a href="" class="btn btn-red waves-effect disabled" aria-disabled="true"><i class="fa fa-globe" aria-hidden="true"></i> No Supporting Websource</a>
                @else
                  <a href="{{ $event->weblink }}" class="btn btn-red waves-effect" aria-disabled="false" target="_blank" ><i class="fa fa-globe" aria-hidden="true"></i> View Websource</a>
                @endif
              </li>
              <li class="list-group-item">
                @if ($event->docpath == "" or null)
                  <a href="{{ asset($event->docpath) }}" class="btn btn-secondary waves-effect disabled" aria-disabled="true"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> No Supporting Document</a>
                @else
                  <a href="{{ asset($event->docpath) }}" class="btn btn-secondary waves-effect" aria-disabled="false" target="_blank" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Event Documentation</a>
                @endif
              </li>
              <li class="list-group-item">
                <!-- Like button -->
                <form method="post">
                  @csrf
                  @if ($event->canLike == true and $event->finished == false)
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-thumbs-up" aria-hidden="true"></i> I'm interest in this event!</button>
                  @else
                    @if($event->finished == false)
                      <button disabled type="submit" class="btn btn-primary" ><i class="fa fa-thumbs-up" aria-hidden="true"></i> Already registered interest</button>
                    @else
                      <button disabled type="submit" class="btn btn-primary" ><i class="fa fa-thumbs-up" aria-hidden="true"></i> Event has finished</button>
                    @endif
                  @endif
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <small class="text-muted">Created: {{ $format['created_at'] }}</small>
        <br>
        <small class="text-muted">Last updated: {{ $format['updated_at'] }}</small>
      </div>
    </div>
  </div>
</div>
@endsection

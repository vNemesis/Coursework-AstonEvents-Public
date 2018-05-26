@extends('layouts.app')

@section('jumbo')
<div class="jumbotron jumbotron-fluid jumbotron-image">
  <div class="container">
    <h1 class="display-4">Aston Events</h1>
    <p class="lead">Providing a centralised place for all events in or around Aston University!</p>
    <hr />
    @guest
    <a href="{{ route('allevents') }}" class="btn btn-amber"><i class="fa fa-calendar-o" aria-hidden="true"></i> Take a look at all events here!</a>
    @else
    <h4>Hi {{ Auth::user()->name }}!</h4>
    <p>Now that your logged in why not:</p>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <a href="{{ route('addevent') }}" class="btn btn-amber"><i class="fa fa-edit" aria-hidden="true"></i> Create an event</a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('myaccount') }}" class="btn btn-amber" data-toggle="tooltip" title="View your information and events" ><i class="fa fa-user" aria-hidden="true"></i> Manage your account</a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('allevents') }}" class="btn btn-amber"><i class="fa fa-calendar-o" aria-hidden="true"></i> Browse events</a>
      </div>
    </div>
    <br />
    <p><strong>Note: You can also view these options in the top-right menu</strong></p>
    </div>
    @endguest
  </div>
</div>
@endsection

@section('content')
<br />
<h2><strong>Latest Events</strong></h2>

<?php
  $count = 0;
  $oldThree = 0;
?>
<div class="card-deck text-center">
  @foreach($events as $event)

  <div class="card text-center w-33 border-dark">

    <!-- Card Image -->
    <div class="view overlay zoom">
      <img class="card-img-top" src="{{ asset($event->imagepath . $event->imagename . '_1.jpg') }}" alt="Card image cap">
      <a href="{{ route('event', $event->id) }}">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <div class="card-body">
      {{-- <img class="image-format" src="{{ asset($event->imagepath . $event->imagename . '_1.jpg') }}"/> --}}
      <hr />
      <h3 class="card-title">{{ $event->name }}</h3>
      <h4><span class="{{ $event->badge }}">{{ $event->text }}</span></h4>
      <p class="card-text"><?php echo substr($event->shortdescription, 0, 250); ?></p>
    </div>
    <a href="{{ route('event', $event->id) }}" class="btn btn-amber waves-effect">See more</a>
    <div class="card-footer">
      <small class="text-muted">Created {{ $event->created }}</small>
    </div>
  </div>

  <?php
   $count++;

   if ($count == ($oldThree + 3)) {
     $oldThree + 3;

     echo '</div>

     <br />

     <div class="card-deck text-center">';

   }
   ?>
      @endforeach

</div>
<hr />
<div class="row justify-content-center">
  @guest
    <h4>Why not become an Event Organiser? <a class="btn btn-outline-green" href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Click here to Register Today!</a></h4>
  @endguest
</div>
@endsection

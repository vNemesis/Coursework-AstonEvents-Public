@extends('layouts.app')

@section('css')
<link href="{{ asset('css/myaccount.css') }}" rel="stylesheet">
@endsection

@section('header')
@if(session('flag'))
<br />
  @if(session('flag') == 1)
  <div class="alert alert-success alert-dismissible fade show">
    Event deleted
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
    Information changed successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @elseif(session('flag') == 4)
  <div class="alert alert-danger alert-dismissible fade show">
    Unable to process request this time. Try again later.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @elseif(session('flag') == 5)
  <div class="alert alert-danger alert-dismissible fade show">
    Your current password do not match our record
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </div>
  @endif
@endif
@endsection

@section('content')
  <br />
{{-- @guest
  <div class="row text-center">
    <div class="col-md-12 align-middle">
      <h2> You are not logged in! </h2>
    </div>
  </div>
@else --}}
  <h2> Account information</h2>
  <table class="table">
    <tr><th>Name:</th><td>{{ Auth::user()->name }}</td></tr>
    <tr><th>E-mail:</th><td>{{ Auth::user()->email }}</td></tr>
    <tr><th>Phone:</th><td>{{ Auth::user()->phone }}</td></tr>
  </table>
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">Edit information</button>
  <div class="collapse" id="collapseImage">
    <form method="POST" action="myaccount/basic">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Auth::user()->phone }}" autofocus>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Basic Info') }}
                </button>
            </div>
        </div>
    </form>
    <hr />
    <form method="POST" action="myaccount/password">
        @csrf
        <div class="form-group row">
            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

            <div class="col-md-6">
                <input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required>

                @if ($errors->has('current_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Password') }}
                </button>
            </div>
        </div>
    </form>
  </div>
  <br />
  <br />
  <h4>Events created by you</h4>
  <table class="table table-sm table-hover">
    <tr class="elegant-color text-white">
      <th>Event ID</th>
      <th>Name</th>
      <th>Event Date</th>
      <th>Date Created</th>
      <th>Functions</th>
    </tr>
  @foreach($newPersonalEvents as $event)
    <tr>
      <td class="align-middle">{{ $event->id }}</td>
      <td class="align-middle">{{ $event->name }}</td>
      <td class="align-middle">{{ $event->datetime }} <span class="{{$event->badge}}" {{$event->badgeVisible}}>Finished</span></td>
      <td class="align-middle">{{ $event->created_at }}</td>
      <td class="link align-middle">
        <a href="{{route('event', $event->id)}}" class="btn btn-secondary"><i class="fa fa-calendar-o" aria-hidden="true"></i> View</a>
        <a href="{{route('updateevent', $event->id)}}" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
        <form class="inline" onsubmit="return confirm('Do you really want to delete this event? This can not be un-done!');" action="{{ route('myaccount') }}" method="post" >
          @csrf
          <input type="hidden" name="deleteid" value="{{ $event->id }}" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i> Delete</button>
        </form>
      </td>
    </tr>
  @endforeach
    </table>
    <hr />
    <div class="row justify-content-center">
      {{ $newPersonalEvents->links() }}
    </div>
{{-- @endguest --}}
@endsection

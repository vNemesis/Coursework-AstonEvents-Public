@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Aston Events') }}: Uh-oh!</title>
@endsection

@section('header')
<br />
<h2>Hold your horses!</h2>
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-12">
    <h3 class="text-danger">Your account has not been approved yet, please wait for an admin to approve your account and try again later.</h3>
  </div>
</div>
@endsection

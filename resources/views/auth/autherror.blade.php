@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Aston Events') }}: Uh-oh!</title>
@endsection

@section('header')
<br />
<h2>Welp thats not correct....</h2>
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-12">
    <h3 class="text-danger">You're not authorised to go here, please register or login in to access this page!</h3>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Aston Events') }}: References</title>
@endsection

@section('header')
<br />
<h2>Site by Harman Uppal - Aston University 2018</h2>
<h2>This site uses:</h2>
@endsection

@section('content')
<ul class="text-black">
  <li>Bootstrap at https://getbootstrap.com/</li>
  <li>Bootstrap select at https://github.com/snapappointments/bootstrap-select</li>
  <li>Material Design for Bootstrap at https://mdbootstrap.com/</li>
  <li>Font Awesome at https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css</li>
  <li>Google Raleway at https://fonts.googleapis.com/css?family=Raleway:300,400,600</li>
  <li>Markdown Editor at https://github.com/Inscryb/inscryb-markdown-editor</li>
</ul>
<h6>Version 1.0.6</h6>
@endsection

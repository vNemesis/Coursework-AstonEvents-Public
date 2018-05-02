@extends('layouts.app')

@section('css')
<link href="{{ asset('css/allevents.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('js/allevents.js') }}"></script>
@endsection

@section('jumbo')
  <div class="jumbotron jumbotron-fluid jumbotron-image">
    <div class="container">
      <h1 class="display-4">{{ $name }}</h1>
      <p class="lead">Take a look at the {{ strtolower($name) }} below</p>
      <p>Looking for something specific? Try filtering events using the options <a href="" data-toggle="collapse" data-target="#collapseFilter">here</a></p>
    </div>
  </div>
@endsection

@section('header')
  <!-- Filter and sorting Controls -->
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><i class="fa fa-filter" aria-hidden="true"></i> Filter and Sort results</button>
  <br /><br />
  <strong>Active filters: </strong>
  @isset($badges['category'])
  <span class="badge badge-primary">{{ $badges['category'] }}</span>
  @endisset
  @isset($badges['date'])
  <span class="badge badge-secondary">{{ $badges['date'] }}</span>
  @endisset
  @isset($badges['interest'])
  <span class="badge badge-dark">{{ $badges['interest'] }}</span>
  @endisset
  @isset($badges['sorting'])
  <span class="badge badge-info">{{ $badges['sorting'] }}</span>
  @endisset
  @isset($badges['search'])
  <span class="badge badge-warning">{{ $badges['search'] }}</span>
  @endisset
  <br />
  <div class="collapse" id="collapseFilter">
    <br />
    <ul id="filterNotif" hidden="true" class="alert alert-danger"></ul>
    <form id="filterForm" class="form-control-sm" method="GET" action="{{ route('allevents') }}">
      <div class="form-row">
        <div class="form-group col-lg-2 offset-lg-1">
          <label for="filterCategory">Category</label>
          <select class="form-control" id="filterCategory" name="filterCategory" type="text" >
            <!-- Check which was selected last to set the currently selected one -->
            <option <?php if($search['filterCategory'] == ""){ echo "selected"; }; ?> value="">None</option>
            <option <?php if($search['filterCategory'] == "sport"){ echo "selected"; }; ?> value="sport">Sport</option>
            <option <?php if($search['filterCategory'] == "culture"){ echo "selected"; }; ?> value="culture">Culture</option>
            <option <?php if($search['filterCategory'] == "other"){ echo "selected"; }; ?> value="other">Other</option>
          </select>
        </div>
        <div class="form-group col-lg-2">
            <label for="filterDateMethod"><i class="fa fa-calendar" aria-hidden="true"></i> Date Method</label>
            <select class="form-control" id="filterDateMethod" name="filterDateMethod" type="text" >
              <option <?php if($search['filterDateMethod'] == ""){ echo "selected"; }; ?> value="">None</option>
              <option <?php if($search['filterDateMethod'] == "before"){ echo "selected"; }; ?> value="before">Before</option>
              <option <?php if($search['filterDateMethod'] == "after"){ echo "selected"; }; ?> value="after">After</option>
              <option <?php if($search['filterDateMethod'] == "on"){ echo "selected"; }; ?> value="on">On</option>
            </select>
          <br />
            <label for="filterDate">Date</label>
            <input id="filterDate" type="date" class="form-control" name="filterDate" value="{{ $search['filterDate'], old('date') }}" >
        </div>
        <div class="form-group col-lg-2">
            <label for="filterLikenessMethod"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Interest</label>
            <select class="form-control" id="filterLikenessMethod" name="filterLikenessMethod" type="text" >
              <option <?php if($search['filterLikenessMethod'] == ""){ echo "selected"; }; ?> value="">None</option>
              <option <?php if($search['filterLikenessMethod'] == "lessthan"){ echo "selected"; }; ?> value="lessthan">Less Than</option>
              <option <?php if($search['filterLikenessMethod'] == "greaterthan"){ echo "selected"; }; ?> value="greaterthan">Greater Than</option>
              <option <?php if($search['filterLikenessMethod'] == "equal"){ echo "selected"; }; ?> value="equal">Equal to</option>
            </select>
          <br />
            <label for="filterLikeness">Amount</label>
            <input id="filterLikeness" type="number" class="form-control" name="filterLikeness" value="{{ $search['filterLikeness'], old('filterLikeness') }}" placeholder="Amount of people interested" >
        </div>
        <div class="form-group col-lg-2">
            <label for="sortby"><i class="fa fa-sort" aria-hidden="true"></i> Sort by</label>
            <select class="form-control" id="sortby" name="sortby" type="text" >
              <option <?php if($search['sortby'] == ""){ echo "selected"; }; ?> value="">None</option>
              <option <?php if($search['sortby'] == "name"){ echo "selected"; }; ?> value="name">Name</option>
              <option <?php if($search['sortby'] == "datetime"){ echo "selected"; }; ?> value="datetime">Date</option>
              <option <?php if($search['sortby'] == "likeness"){ echo "selected"; }; ?> value="likeness">interest</option>
              <option <?php if($search['sortby'] == "created_at"){ echo "selected"; }; ?> value="created_at">Date created</option>
              <option <?php if($search['sortby'] == "updated_at"){ echo "selected"; }; ?> value="updated_at">Date updated</option>
            </select>
          <br />
          <label for="sortbyMethod">Order</label>
          <select class="form-control" id="sortbyMethod" name="sortbyMethod" type="text" >
            <option <?php if($search['sortbyMethod'] == "descending"){ echo "selected"; }; ?> value="descending"><i class="fa fa-sort-desc" aria-hidden="true"></i> Descending</option>
            <option <?php if($search['sortbyMethod'] == "ascending"){ echo "selected"; }; ?> value="ascending"><i class="fa fa-sort-asc" aria-hidden="true"></i> Ascending</option>
          </select>
        </div>
        <div class="form-group col-lg-2">
            <label for="searchTextMethod"><i class="fa fa-search" aria-hidden="true"></i> Search</label>
            <select class="form-control" id="searchTextMethod" name="searchTextMethod" type="text" >
              <option <?php if($search['searchTextMethod'] == ""){ echo "selected"; }; ?> value="">None</option>
              <option <?php if($search['searchTextMethod'] == "name"){ echo "selected"; }; ?> value="name">Name</option>
              <option <?php if($search['searchTextMethod'] == "description"){ echo "selected"; }; ?> value="description">Description</option>
              <option <?php if($search['searchTextMethod'] == "location"){ echo "selected"; }; ?> value="location">Location</option>
            </select>
          <br />
            <label for="searchText">Keywords (seperate with spaces)</label>
            <input id="searchText" type="text" class="form-control" name="searchText" value="{{ $search['searchText'], old('searchText') }}" placeholder="Search text (max 50 characters)" maxlength="50" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-12">
          <hr />
          <button class="btn btn-outline-success" type="button" onclick="validateFilter()"><i class="fa fa-search" aria-hidden="true"></i> Search & Filter</button>
          <button class="btn btn-outline-warning" type="button" onclick="clearFilter(false)"><i class="fa fa-rotate-left" aria-hidden="true"></i> Clear Fields</button>
          <button class="btn btn-outline-danger" type="button" onclick="clearFilter(true)"><i class="fa fa-rotate-left" aria-hidden="true"></i> Clear Fields & Refresh</button>
        </div>
      </div>
    </form>
  </div>
  <br />
@endsection

@section('content')
<!-- results text -->
<h6>{{ $results }}</h6>
<div class="row justify-content-center">
  {{ $events->links() }}
</div>
<hr />
<!-- Displays events - START -->
@if( $search['sortby'] == '' ) <!-- If results are not being sorted then display deck version -->
<?php $count = 0; $oldThree = 0; ?>  <!-- Set php variables for logic to add a new deck if needed -->
<div class="card-deck">
@else <!-- else begin table version  -->
<table class="table">
   <thead>
     <tr>
       <th style="width: 20%"></th>
       <th style="width: 10%">Name</th>
       <th style="width: 30%">Description</th>
       <th style="width: 5%">Category</th>
       <th style="width: 15%">Time Date</th>
       <th style="width: 5%">interest</th>
       <th style="width: 10%">Options</th>
       <th style="width: 5%">Created</th>
     </tr>
   </thead>
   <tbody>
@endif
 @foreach($events as $event)
 @if( $search['sortby'] != '' ) <!-- Sorted version -->
      <tr>
        <td class="align-middle">
          <div class="view overlay zoom">
            <img class="card-img-top" src="{{ asset($event->imagepath . $event->imagename . '_1.jpg') }}" alt="Card image cap">
            <a href="{{ route('event', $event->id) }}">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
        </td>
        <td class="align-middle">{{ $event->name }}</td>
        <td class="align-middle">
          <div>
            <?php echo substr($event->description, 0, 150); ?>...
          </div>
          <div>
            <strong>Location: </strong> {{ $event->location }}
          </div>
        </td>
        <td class="align-middle">{{ $event->category }}</td>
        <td class="align-middle">{{ $event->format['time'] }}, {{ $event->format['date'] }}</td>
        <td class="align-middle">{{ $event->likeness }}</td>
        <td class="align-middle"><a href="{{ route('event', $event->id) }}" class="btn btn-amber">See more</a></td>
        <td class="align-middle"><small><?php $daysOld=time() - strtotime($event->created_at); echo round($daysOld / (60 * 60 * 24)); ?> days ago</small></td>
      </tr>
 @else <!-- Non sorted version -->
 <div class="card border-dark text-center w-33">

   <!-- Card Image -->
   <div class="view overlay zoom">
     <img class="card-img-top" src="{{ asset($event->imagepath . $event->imagename . '_1.jpg') }}" alt="Card image cap">
     <a href="{{ route('event', $event->id) }}">
       <div class="mask rgba-white-slight"></div>
     </a>
   </div>

   <div class="card-body">
     <hr />
     <h4 class="card-title">{{ $event->name }}</h4>
     <h4><span class="{{ $event->badge }}">{{ $event->text }}</span></h4>
     <p class="card-text"><?php echo substr($event->description, 0, 250); ?></p>
     <ul class="list-group list-group-flush">
       <li class="list-group-item"><strong>Category:</strong> {{ $event->category }}</li>
       <li class="list-group-item">{{ $event->format['time'] }}, {{ $event->format['date'] }}</li>
       <li class="list-group-item">{{ $event->location }}</li>
       <li class="list-group-item">{{ $event->likeness }} interested</li>
     </ul>
   </div>
   <a href="{{ route('event', $event->id) }}" class="btn btn-amber">See more</a>
   <div class="card-footer">
     <small class="text-muted">Created {{ $event->created_at_format }}</small>
   </div>
 </div>
<!-- Logic to handle createding a second (or third if pagination value is increased) deck -->
 <?php $count++;  if ($count == ($oldThree + 3)) { $oldThree = $oldThree + 3;
    echo '</div>

    <br />

    <div class="card-deck">';
  }
  ?>
  @endif
  @endforeach
  @if( $search['sortby'] == '' )
    </div>
  @else
  </tbody>
</table>
  @endif
<!-- Display Events - END -->
<hr />
<div class="row justify-content-center">
  {{ $events->links() }}
</div>
@endsection

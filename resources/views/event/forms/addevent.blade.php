@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Aston Events') }}: Add event</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/inscrybmde@1.11.3/dist/inscrybmde.min.css">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/inscrybmde@1.11.3/dist/inscrybmde.min.js"></script>
<script src="js/fileedit.js"></script>
@endsection


@section('content')
  <br />
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
      <h5>There were some errors in your event!</h5>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </div>
  @endif
<div class="row justify-content-center">
    <div class="col-md-10">
      <br />
        <div class="card">
            <div class="card-header">{{ __('Add Event') }}</div>

            <div class="card-body">
                <form method="post" action="addevent" enctype="multipart/form-data">
                    @csrf

                    <!-- Name of event -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Category of event -->
                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                        <div class="col-md-6">
                            <select id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('name') }}" required autofocus>
                              <option value="sport">Sport (football, swimming, cricket etc.)</option>
                              <option value="culture">Culture (Hindu, Jewish, Chinese etc.)</option>
                              <option value="other">Other (Music, Photography etc.)</option>
                            </select>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Time of the event -->
                    <div class="form-group row">
                        <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                        <div class="col-md-6">
                            <input id="time" type="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" value="{{ old('time') }}" required autofocus>

                            @if ($errors->has('time'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Date of the event -->
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required autofocus>

                            @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Short Description of event -->
                    <div class="form-group row">
                        <label for="shortdescription" class="col-md-4 col-form-label text-md-right">{{ __('Short Description') }}</label>

                        <div class="col-md-6">
                            <textarea id="shortdescription" type="text" class="form-control{{ $errors->has('shortdescription') ? ' is-invalid' : '' }}" name="shortdescription" rows="3" required autofocus>{{ old('shortdescription') }}</textarea>
                            <div class="text-right" id="sdfeedback"></div>
                            <br />
                            <ul>
                              <li><strong>Max:</strong> 250 characters</li>
                              <li>Simple description shown on search page</li>
                            </ul>

                            @if ($errors->has('shortdescription'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('shortdescription') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Long Description of event -->
                    <div class="form-group row">
                        <label for="longdescription" class="col-md-4 col-form-label text-md-right">{{ __('Long Description') }}</label>

                        <div class="col-md-6">

                        <!-- Tabs for editor -->
                          <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#descriptionTab">Text</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#editorTab">Editor</a>
                            </li>
                          </ul>

                          <br />

                          <!-- Editor and text views-->
                          <div class="tab-content">
                            <div id="descriptionTab" class="tab-pane container active">
                              <textarea id="longdescription" type="text" class="form-control{{ $errors->has('longdescription') ? ' is-invalid' : '' }}" name="longdescription" rows="10" required autofocus>{{ old('longdescription') }}</textarea>
                            </div>
                            <div id="editorTab" class="tab-pane container fade">
                              <textarea id="editor" rows="10"></textarea>
                              <button type="button" class="btn btn-outline-success" onclick="passValue();">Save</button>
                            </div>
                          </div>
                            <div class="text-right" id="ldfeedback"></div>
                          <hr />

                            <ul>
                              <li><strong>Max:</strong> 3500 characters</li>
                              <li>More detailed description</li>
                              <li>Uses Markdown formatting</li>
                              <li>Need more space? You can also upload a PDF</li>
                            </ul>

                            @if ($errors->has('longdescription'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('longdescription') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <!-- Location of event -->
                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                        <div class="col-md-6">
                            <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" required autofocus>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Related events -->
                    <div class="form-group row">
                        <label for="related" class="col-md-4 col-form-label text-md-right">{{ __('Related Events') }}</label>

                        <div class="col-md-6">
                            <select id="related" type="text" class="selectpicker form-control{{ $errors->has('related') ? ' is-invalid' : '' }}" title="Select from all events..." data-selected-text-format="count" data-size="6" data-live-search="true" name="related[]" multiple autofocus>
                              @foreach($events as $eventAll)
                                <option value="{{$eventAll->id}}">{{$eventAll->name}}</option>
                              @endforeach
                            </select>
                            <ul>
                              <li><strong>Max:</strong> 6 events</li>
                            </ul>

                            @if ($errors->has('related'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('related') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- websource of event -->
                    <div class="form-group row">
                        <label for="weblink" class="col-md-4 col-form-label text-md-right">{{ __('Relevant weblink') }}</label>

                        <div class="col-md-6">
                            <input id="weblink" type="text" class="form-control{{ $errors->has('weblink') ? ' is-invalid' : '' }}" name="weblink" value="{{ old('weblink') }}" autofocus data-toggle="tooltip" title="Paste a weblink to any relevant source for this event, such as a sign up form or company site">
                            @if ($errors->has('weblink'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('weblink') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <!-- Image for event -->
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right"><i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('Image') }}</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" value="" required multiple autofocus>
                            <ul>
                              <li><strong>Max:</strong> 64mb</li>
                              <li><strong>Minimum:</strong> 300x168px - Maximum:1920x1080px</li>
                              <li><strong>Reccommeded:</strong> 16:9 aspect ratio and 1280x720px</li>
                              <li>Images will be resized to 1280x720px</li>
                              <li>Images smaller than 960x490 may appear blurry</li>
                              <li>Images will be ordered by name when selected, name your images in the order you would like them to appear</li>
                              <li>First image selected will be used as the main one</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Doc for event -->
                    <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ __('Event Document') }} (Max: 64kb)</label>

                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" value="{{ old('file') }}" autofocus>
                            <ul>
                              <li><strong>Max:</strong> 5mb</li>
                              <li>File must be a PDF</li>
                            </ul>

                            @if ($errors->has('file'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-amber">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Start simple MDE -->
<script>
    var inscrybmde = new InscrybMDE({
        element: document.getElementById("editor"),
        hideIcons: ["image", "table", "side-by-side", "fullscreen", "quote"],
        promptURLs: true,
        placeholder: "Enter description here...",
    });

    function passValue()
    {
      alert("Description Saved");
      document.getElementById("longdescription").innerHTML = inscrybmde.value();
    }
</script>
@endsection

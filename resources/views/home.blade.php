@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">{{ trans('home.index.title') }}</h1>
    <p class="lead">{{ trans('home.index.text') }}</p>
  </div>
</div>
@endsection

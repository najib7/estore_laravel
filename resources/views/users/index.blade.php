@extends('layouts.master')

{{-- @section('title', __('app.users.title')) --}}

@section('content')


<users :can-update="true"></users>


@endsection

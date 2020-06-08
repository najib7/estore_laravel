@extends('layouts.master')

{{-- @section('title', __('app.suppliers.title')) --}}

@section('content')

<suppliers></suppliers>
{{-- <users :can-update="{{ auth()->user()->can('update', 'user') ? 'true' : 'false' }}"></users> --}}

@endsection

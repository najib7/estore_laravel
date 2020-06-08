@extends('layouts.master')


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="{{ mix('js/chart.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('app.stats.last_count') }}
            </div>
            <div class="card-body">
                <canvas id="chart-count"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('app.stats.last_profits') }}
            </div>
            <div class="card-body">
                <canvas id="chart-profits"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row my-4">
    <div class="col-md-4">
        <products-stats :stats="{{ json_encode($stats['products']) }}"></products-stats>
    </div>
    <div class="col-md-4">
        <purchases-stats :stats="{{ json_encode($stats['purchases']) }}"></purchases-stats>
    </div>
    <div class="col-md-4">
        <sales-stats :stats="{{ json_encode($stats['sales']) }}"></sales-stats>
    </div>
</div>
@endsection

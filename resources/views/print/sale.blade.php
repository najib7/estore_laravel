@extends('print.template')

@section('content')
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>
    <h1>SALE INVOICE {{ $invoice->id }}</h1>
    <div id="project">
        <div><span>CLIENT</span> {{ $invoice->client->name }}</div>
        <div><span>PAYMENT TYPE</span> {{ $invoice->payment_type }}</div>
        <div><span>PAYMENT STATUS</span> {{ $invoice->payment_status }}</div>
        <div><span>DISCOUNT</span> {{ $invoice->discount * 100 }}%</div>
        <div><span>CREATED</span> {{ $invoice->created_at->format('Y-m-d') }}</div>
    </div>
</header>
<main>
    @php
    $map = $invoice->details->map(function($item) {
    return $item->price * $item->quantity;
    });
    $sum = $map->sum();
    @endphp
    <table>
        <thead>
            <tr>
                <th class="service">product</th>
                <th class="desc">product_id</th>
                <th>category</th>
                <th>quantity</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->details as $d)
            <tr>
                <td class="service">{{ $d->product->name }}</td>
                <td class="desc">{{ $d->product->id }}</td>
                <td class="unit">{{ $d->product->category->name }}</td>
                <td class="qty">{{ $d->quantity }}</td>
                <td class="total">{{ $d->price * $d->quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="grand total">TOTAL</td>
                <td class="grand total">{{ $sum }}</td>
            </tr>
        </tbody>
    </table>
</main>
@endsection

@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Bottle Disposal History</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            History of Bottle Disposals
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Disposal Date</th>
                        <th>Small</th>
                        <th>Medium</th>
                        <th>Large</th>
                        <th>Extra Large</th>
                        <th>Double Extra Large</th>
                        <th>Total Quantity</th>
                        <th>Pts Received</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Disposal Date</th>
                        <th>Small</th>
                        <th>Medium</th>
                        <th>Large</th>
                        <th>Extra Large</th>
                        <th>Double Extra Large</th>
                        <th>Total Quantity</th>
                        <th>Pts Received</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($bottleDisposals as $bottleDisposal)
                    <tr>
                        <td>{{ $bottleDisposal->disposal_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $bottleDisposal->small_qty }}</td>
                        <td>{{ $bottleDisposal->med_qty }}</td>
                        <td>{{ $bottleDisposal->large_qty }}</td>
                        <td>{{ $bottleDisposal->xl_qty }}</td>
                        <td>{{ $bottleDisposal->xxl_qty }}</td>
                        <td>{{ $bottleDisposal->bottles_qty }}</td> 
                        <td>{{ $bottleDisposal->points_received }}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

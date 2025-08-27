@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Successful Reward Exchange Requests</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Successful Exchange Requests
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Image Preview</th>
                        <th>Reward Description</th>
                        <th>Exchanged Quantity</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image Preview</th>
                        <th>Reward Description</th>
                        <th>Exchanged Quantity</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($rewardExchanges as $rewardExchange)
                    <tr>
                        <td><img src="{{Vite::asset('storage/app/public/' . $rewardExchange->reward->image_url) }}" alt="Reward Image"  width="100"></td>
                        <td>{{ $rewardExchange->reward->description }}</td>
                        <td>{{ $rewardExchange->qty }}</td>
                        <td>{{ $rewardExchange->created_at->format('Y-m-d h:i A') }}</td>
                        <td>{{ $rewardExchange->status }}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

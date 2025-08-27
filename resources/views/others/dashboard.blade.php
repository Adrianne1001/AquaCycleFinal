@extends('layouts.nav')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
            Account ID: <span style="font-weight: bold; color: black;">{{ Auth::user()->account_id }}</span>
        </li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">{{$userStats->outstanding_points}} points</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">Available Reward Points</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">{{$userStats->total_accu_points}} points</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">Total Accumulated Points</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">{{$successfulExchanges}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">Total Successful Reward Exchange</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">{{$rejectedExchanges}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">Total Rejected Reward Exchange</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Daily Acumulated Points (Area Chart)
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Monthly Plastic Disposal (Bar Chart)
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Reward Exchange Requests
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Img Preview</th>
                        <th>Reward Description</th>
                        <th>Exchanged Quantity</th>
                        <th>Request Date</th> 
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        
                        <th>Img Preview</th>
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
    <script>
        var dailyLabels = @json($dailyLabels);
        var dailyPoints = @json($dailyPoints);
        var monthlyLabels = @json($monthlyLabels);
        var monthlyBottleDisposals = @json($monthlyBottleDisposals);
    </script>
@endsection

@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Active Reward Exchange Requests</h1>
    <br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Pending/Approved Exchange Requests
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Reward Description</th>
                        <th>Exchanged Qty</th>
                        <th>Pts per Qty</th>
                        <th>Request Date</th> 
                        <th>Requested By</th> 
                        <th>ID #</th> 
                        {{-- <th>Year Level</th>  --}}
                        <th>Email</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Reward Description</th>
                        <th>Exchanged Qty</th>
                        <th>Pts per Qty</th>
                        <th>Request Date</th>
                        <th>Requested By</th> 
                        <th>ID Number</th> 
                        {{-- <th>Year Level</th>  --}}
                        <th>Email</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($rewardExchanges as $rewardExchange)
                    <tr>
                        <td>{{ $rewardExchange->reward->description }}</td>
                        <td>{{ $rewardExchange->qty }}</td>
                        <td>{{ $rewardExchange->reward->points_required }}</td>
                        <td>{{ $rewardExchange->created_at->format('Y-m-d h:i A') }}</td>
                        <td>{{ $rewardExchange->user->name }}</td> 
                        <td>{{ $rewardExchange->user->id_number }}</td> 
                        {{-- <td>{{ $rewardExchange->user->year_level }}</td>    --}}
                        <td>{{ $rewardExchange->user->email }}</td>            
                        <td>{{ $rewardExchange->status }}</td>        
                        <td>
                            @if($rewardExchange->status === "Approved")
                            
                            <form action="{{ route('admin_reward_exchange.claim', $rewardExchange->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to MARK this as CLAIMED?');">
                                @csrf
                                <button type="submit" class="btn btn-success">Mark as Redeemed</button>
                            </form>
                            @else
                            <form action="{{ route('admin_reward_exchange.approve', $rewardExchange->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to APPROVE this request?');">
                                @csrf
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                            <form action="{{ route('admin_reward_exchange.reject', $rewardExchange->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to REJECT this request?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>                              
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

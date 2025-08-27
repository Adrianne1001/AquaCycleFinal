<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            @if(Auth::user()->role == 'Admin')
            <div class="sb-sidenav-menu-heading">Summary</div>
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Profiles</div>
            <a class="nav-link" href="{{ route('reward.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Rewards
            </a>
            <a class="nav-link" href="{{ route('article.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Articles
            </a>
            <a class="nav-link" href="{{ route('user.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Users
            </a>
            <div class="sb-sidenav-menu-heading">Transactions</div>
            <a class="nav-link" href="{{ route('admin_reward_exchange.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Exchange Rewards
            </a>
            <a class="nav-link" href="{{url('admin/RewardExchange/SuccessfulRedeems')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Successful Redeems
            </a>
            <a class="nav-link" href="{{url('admin/RewardExchange/RejectedRequests')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Rejected Requests
            </a>
            @endif
            
            @if(Auth::user()->role == 'Student' || Auth::user()->role == 'Others')
            <div class="sb-sidenav-menu-heading">Summary</div>
            <a class="nav-link" href="{{url('student/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Transactions</div>
            <a class="nav-link" href="{{ route('bottle_disposals.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Disposal History
            </a>
            <a class="nav-link" href="{{ route('reward_exchange.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Exchange Rewards
            </a>
            <a class="nav-link" href="{{url('student/RewardExchange/SuccessfulRedeems')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Successful Redeems
            </a>
            <a class="nav-link" href="{{url('student/RewardExchange/RejectedRequests')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Rejected Requests
            </a>
            @endif
        </div>
    </div>
    
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: </div>
        {{ Auth::user()->role }}
    </div>
</nav>
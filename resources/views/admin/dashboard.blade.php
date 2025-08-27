    @extends('layouts.nav')
    @section('content')
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $trashbagStatus ?? 'N/A' }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white stretched-link">Trashbag Fill Status</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{$usersCount}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white stretched-link">Total Users</span>
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
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Monthly Collected Plastics per Faculty (Bar Chart)
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="20"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Monthly Collected Plastics per Size (Bar Chart)
                    </div>
                    <div class="card-body">
                        <canvas id="mySizeChart" width="100%" height="20"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Daily Released Points (Area Chart)
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="20"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <!--     
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
                            <th>Requested By</th> 
                            <th>Year Level</th> 
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            
                            <th>Img Preview</th>
                            <th>Reward Description</th>
                            <th>Exchanged Quantity</th>
                            <th>Request Date</th> 
                            <th>Requested By</th> 
                            <th>Year Level</th> 
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($rewardExchanges as $rewardExchange)
                        <tr>
                            <td><img src="{{asset('storage/app/public/' . $rewardExchange->reward->image_url) }}" alt="Reward Image"  width="100"></td>                    
                            <td>{{ $rewardExchange->reward->description }}</td>
                            <td>{{ $rewardExchange->qty }}</td>
                            <td>{{ $rewardExchange->created_at->format('Y-m-d h:i A') }}</td>
                            <td>{{ $rewardExchange->user->name }}</td>
                            <td>{{ $rewardExchange->user->year_level }}</td>
                            <td>{{ $rewardExchange->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->

        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Student Leaderboard (Top Accumulated Points)
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>ID Number</th> 
                            <th>Year Level</th>
                            <th>Faculty</th> 
                            <th>Total Points Gained</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>ID Number</th> 
                            <th>Year Level</th>
                            <th>Faculty</th> 
                            <th>Total Points Gained</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($studentRankings as $studentRanking)
                        <tr>
                            <td>{{ $studentRanking->user->name }}</td>
                            <td>{{ $studentRanking->user->email }}</td>
                            <td>{{ $studentRanking->user->id_number}}</td>
                            <td>{{ $studentRanking->user->year_level }}</td>
                            <td>{{ $studentRanking->user->faculty->label() }}</td>  
                            <td>{{ $studentRanking->total_accu_points }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            var dailyLabels = @json($dailyLabels);
            var dailyPoints = @json($dailyPoints);
            
            // Faculty chart data
            var monthlyLabels = @json($monthlyLabels);
            var facultyData = @json($facultyData); 
            var facultyNames = @json($facultyNames); 
            var facultyValues = @json($facultyValues);  
            
            // Add size data for the size chart (with separate labels)
            var monthlySizeData = @json($monthlySizeData);
            var sizeNames = @json($sizeNames);
            var sizeMonthLabels = @json($sizeMonthLabels);
            
            // Debug data
            console.log("Faculty Chart - Monthly Labels:", monthlyLabels);
            console.log("Size Chart - Monthly Labels:", sizeMonthLabels);
            console.log("Size Data:", monthlySizeData);
            console.log("Size Names:", sizeNames);

            var facultyColors = [
                'rgba(255, 99, 132, 1)',  // Red
                'rgba(54, 162, 235, 1)',  // Blue
                'rgba(255, 206, 86, 1)',  // Yellow
                'rgba(75, 192, 192, 1)',  // Green
                'rgba(153, 102, 255, 1)', // Purple
                'rgba(255, 159, 64, 1)',  // Orange
                'rgba(255, 99, 71, 1)',   // Tomato
                'rgba(255, 30, 71, 1)'    // Tomato
            ];

            // Create an empty array to store datasets for the faculty chart
            var datasets = [];

            // Loop over each faculty in the facultyData
            Object.keys(facultyData).forEach(function(faculty, index) {
                datasets.push({
                    label: facultyNames[index], // Use faculty name (enum label) for the chart legend
                    backgroundColor: facultyColors[index], // Use predefined colors for each faculty
                    borderColor: 'rgba(0, 0, 0, 1)',  // Border color for the bars
                    data: facultyData[faculty],  // Array of monthly disposal data for the faculty
                    hoverBackgroundColor: facultyColors[index],  // Use the same color on hover
                    hoverBorderColor: 'rgba(0, 0, 0, 1)'  // Border color on hover
                });
            });

            // Create the chart when the DOM is fully loaded
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById("myBarChart");  // Get the canvas element by its ID
                if (ctx) {
                    var myBarChart = new Chart(ctx, {
                        type: 'bar',  // Set chart type to 'bar'
                        data: {
                            labels: monthlyLabels,  // X-axis labels (months) for faculty chart
                            datasets: datasets,  // Data for each faculty (dataset per faculty)
                        },
                        options: {
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 6
                                    }
                                },
                                y: {
                                    ticks: {
                                        min: 0,
                                        max: Math.max(...[].concat(...Object.values(facultyData))) + 10,  // Adjust the max value dynamically
                                        maxTicksLimit: 5
                                    },
                                    grid: {
                                        display: true
                                    }
                                }
                            },
                            responsive: true,
                            legend: {
                                position: 'top',  // Position of the legend
                                display: true,  // Display the legend
                            },
                            title: {
                                display: true,
                                text: 'Monthly Bottle Disposal per Faculty'  // Chart title
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var faculty = data.datasets[tooltipItem.datasetIndex].label;
                                        return faculty + ": " + tooltipItem.yLabel + " bottles"; // Display faculty name with disposal count
                                    }
                                }
                            }
                        }
                    });
                }
            });
            
            document.addEventListener('DOMContentLoaded', function() {
            console.log("Chart.js is loaded:", typeof Chart !== 'undefined'); // Should log true

            var ctx = document.getElementById("mySizeChart");
            if (!ctx) {
                console.error("Could not find mySizeChart canvas element");
                return;
            }

            console.log("Monthly Size Data:", monthlySizeData);
            console.log("Size Names:", sizeNames);
            console.log("Size Month Labels:", sizeMonthLabels);

            var sizeColors = [
                'rgba(255, 99, 132, 1)',   // Red for Small
                'rgba(54, 162, 235, 1)',   // Blue for Medium
                'rgba(255, 206, 86, 1)',   // Yellow for Large
                'rgba(75, 192, 192, 1)',   // Green for XL
                'rgba(153, 102, 255, 1)'   // Purple for XXL
            ];

            var sizeDatasets = [];
            var numericSizeData = {};

            for (var size in monthlySizeData) {
                numericSizeData[size] = monthlySizeData[size].map(function(val) {
                    return Number(val);
                });
            }

            Object.keys(numericSizeData).forEach(function(size, index) {
                sizeDatasets.push({
                    label: sizeNames[index],
                    backgroundColor: sizeColors[index],
                    borderColor: 'rgba(0, 0, 0, 1)',
                    data: numericSizeData[size],
                    hoverBackgroundColor: sizeColors[index],
                    hoverBorderColor: 'rgba(0, 0, 0, 1)'
                });
            });

            var mySizeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: sizeMonthLabels,
                    datasets: sizeDatasets
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            ticks: {
                                min: 0,
                                max: function() {
                                    var max = 0;
                                    for (var size in numericSizeData) {
                                        var sizeMax = Math.max.apply(null, numericSizeData[size]);
                                        if (sizeMax > max) max = sizeMax;
                                    }
                                    return max + 10;
                                }()
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Monthly Bottle Disposal by Size'
                        }
                    }
                }
            });
        });
            </script>

    <!-- Add the script for size chart -->
    @endsection

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("myBarChart");
    if (ctx) {
        // Check if monthlyBottleDisposals is defined
        if (typeof monthlyBottleDisposals === 'undefined') {
            console.error("monthlyBottleDisposals is not defined");
            return;
        }
        
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyLabels, 
                datasets: [{
                    label: "Monthly Bottle Disposal",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: monthlyBottleDisposals, 
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.max(...monthlyBottleDisposals) + 30, 
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    }
});

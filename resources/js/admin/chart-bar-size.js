Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart for Bottle Sizes
document.addEventListener('DOMContentLoaded', function() {
    // Debug the variables to see if they're available
    console.log("Loading size chart script");
    
    var ctx = document.getElementById("mySizeChart");
    if (!ctx) {
        console.error("Could not find mySizeChart canvas element");
        return;
    }
    
    if (typeof monthlySizeData === 'undefined' || typeof sizeNames === 'undefined' || typeof sizeMonthLabels === 'undefined') {
        console.error("Required variables are not defined", {
            monthlySizeData: typeof monthlySizeData,
            sizeNames: typeof sizeNames,
            sizeMonthLabels: typeof sizeMonthLabels
        });
        return;
    }
    
    console.log("Creating size chart with labels:", sizeMonthLabels);
    
    var sizeColors = [
        'rgba(255, 99, 132, 1)',   // Red for Small
        'rgba(54, 162, 235, 1)',   // Blue for Medium
        'rgba(255, 206, 86, 1)',   // Yellow for Large
        'rgba(75, 192, 192, 1)',   // Green for XL
        'rgba(153, 102, 255, 1)'   // Purple for XXL
    ];

    // Create an empty array to store datasets for the chart
    var sizeDatasets = []; // Different variable name to avoid conflicts

    // Convert all data values to numbers
    var numericSizeData = {};
    for (var size in monthlySizeData) {
        numericSizeData[size] = monthlySizeData[size].map(function(val) {
            return Number(val); // Ensure all values are numbers
        });
    }

    // Loop over each size in the monthlySizeData
    var sizeKeys = Object.keys(numericSizeData);
    sizeKeys.forEach(function(size, index) {
        sizeDatasets.push({
            label: sizeNames[index], // Use size name for the chart legend
            backgroundColor: sizeColors[index], // Use predefined colors for each size
            borderColor: 'rgba(0, 0, 0, 1)',  // Border color for the bars
            data: numericSizeData[size],  // Array of monthly disposal data for the size
            hoverBackgroundColor: sizeColors[index],  // Use the same color on hover
            hoverBorderColor: 'rgba(0, 0, 0, 1)'  // Border color on hover
        });
    });

    var mySizeChart = new Chart(ctx, {
        type: 'bar',  // Set chart type to 'bar'
        data: {
            labels: sizeMonthLabels,  // Use size-specific month labels
            datasets: sizeDatasets,  // Data for each size (dataset per size)
        },
        options: {
            scales: {
                xAxes: [{  // Fix for Chart.js 2.8.0 syntax
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{  // Fix for Chart.js 2.8.0 syntax
                    ticks: {
                        min: 0,
                        // Calculate max value dynamically from numeric data
                        max: function() {
                            // Find the maximum value across all size arrays
                            var max = 0;
                            for (var size in numericSizeData) {
                                var sizeMax = Math.max.apply(null, numericSizeData[size]);
                                if (sizeMax > max) max = sizeMax;
                            }
                            return max + 10; // Add some padding
                        }(),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }]
            },
            responsive: true,
            legend: {
                position: 'top',  // Position of the legend
                display: true,  // Display the legend
            },
            title: {
                display: true,
                text: 'Monthly Bottle Disposal by Size'  // Chart title
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var size = data.datasets[tooltipItem.datasetIndex].label;
                        return size + ": " + tooltipItem.yLabel + " bottles"; // Display size name with disposal count
                    }
                }
            }
        }
    });
});
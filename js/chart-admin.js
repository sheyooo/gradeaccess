$(function() {

    var categoryData = [
        ["Maths", 10],
        ["English", 8],
        ["Physics", 4],
        ["Biology", 100],
        ["Chemistry", 17]
    ];

    var plot;

    $.get("process/workers/admin_chart.php", function(data) {
        //alert(data);
        categoryData = $.parseJSON(data);
        initFlot();
    });

    $(window).resize(function() {
        plot.resize();
        plot.setupGrid();
        plot.draw();
    });

    function initFlot() {

        plot = $.plot(".category", [categoryData], {
            colors: ['#e67e22'],
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: 'center',
                    fill: 1,
                    horizontal: false
                },
                shadowSize: 0
            },
            grid: {
                color: '#c2c2c2',
                borderColor: '#f0f0f0',
                borderWidth: 1
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            },
            yaxis: {
                max: 100
            }
        });
    }


});

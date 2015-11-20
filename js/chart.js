$(function () {

    $('.chart, .visits').easyPieChart({
        size: 150,
        lineWidth: 20,
        barColor: '#1582DC',
        trackColor: '#D0DBEC',
        lineCap: 'butt',
        scaleColor: false,
        easing: 'easeOutBounce',
        onStep: function (from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
        }
    });

    $(".piechart").each(function () {
        var canvas = $(this).find("canvas");
        $(this).css({ 
            "width": canvas.width(),
            "height": canvas.height()
        });
    });
});
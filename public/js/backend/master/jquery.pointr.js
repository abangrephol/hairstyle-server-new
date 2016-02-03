/**
 * Created by Abu Myria on 12/4/2015.
 */

(function ($) {

    $.fn.pointr = function (config) {
        $(this).parent().css({
            position: "relative"
        });
        $(this).click(function (e) {

            var x = e.offsetX;
            var y = e.offsetY;

            var normalizedX = x / $(this).width();
            var normalizedY = y / $(this).height();

            var point = $(this).parent().find("[data-role=pointer]");
            if (point.length == 1) {
                point.css({
                        left: x - 10,
                        top: y - 10
                    })
                    .hide()
                    .fadeIn();
            }
            else {
                point = $("<div/>")
                    .attr("data-role", "pointer")
                    .css({
                        position: "absolute",
                        left: x - 8,
                        top: y,
                        padding: "8px",
                        background: "#F25",
                        border: "solid 2px white",
                        borderRadius: "36px",
                        boxShadow: "0 0 16px rgba(0,0,0,.5)"
                    })
                    .appendTo($(this).parent())
                    .fadeIn();
            }

            if (config.callback) {
                config.callback(normalizedX, normalizedY);
            }
        });
    };

}(jQuery));
// JavaScript source code index

$(document).ready(function () {
    var vleft = 0;
    var vright = 0;
    var startPos = 0;
    $("#arrowRight").click(function () {    
        $("#arrowRight").animate({ width: 26 }, 100);
        $("#arrowRight").animate({ width: 25 }, 100);
        if (startPos < 0) {
            vleft += 250;
            $(".move").animate({
                left: vleft
            });
            startPos += 250;
        }
    });

    $("#arrowLeft").click(function () {
        $("#arrowLeft").animate({ width: 26 }, 100);
        $("#arrowLeft").animate({ width: 25 }, 100);
        if (startPos > -1250) {
            if (startPos <= 0) {
                vleft -= 250;
                $(".move").animate({
                    left: vleft
                });
                startPos -= 250;
            }
        }
    });
});
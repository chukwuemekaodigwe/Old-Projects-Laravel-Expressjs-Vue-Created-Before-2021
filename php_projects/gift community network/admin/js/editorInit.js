function formWysiwyg() {
    "use strict";

    /*----------- BEGIN cleditor CODE -------------------------*/
    editor = $("#cleditor").cleditor({ width: "100%", height: "100%" })[0].focus();
    $(window).resize();

    $(window).resize(function () {
        var $win = $('#cleditorDiv');
        $("#cleditor").width($win.width() - 24).height($win.height() - 24).offset({
            left: 15,
            top: 15
        });
        editor.refresh();
    });
    /*----------- END cleditor CODE -------------------------*/

}
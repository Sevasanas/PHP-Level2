
    $(".close__modal__btn")[0].onclick = function () {
        $("#modal__window").css("display", "none");
        $("#modal__content_wrp").html("");
    };

    document.onclick = function (e) {
        if ($(e.target).is("#modal__window")) {
            $("#modal__window").css("display", "none");
            $("#modal__content_wrp").html("");
        };
    };      

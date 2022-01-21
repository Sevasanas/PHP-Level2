
    $(".tab_btn").on({"click": function(){
        $(".active_btn").removeClass("active_btn");
        let tab = $(this).attr("data-tab");
        $(this).addClass("active_btn");
        $(".tab_item:not(#tab-" + tab + ")").fadeOut(150);
        setTimeout(function(){
            $("#tab-" + tab).fadeIn(150);
        }, 150);       
        }
    })



let toggleBtn = $("#header_toggle_btn");

toggleBtn.on("click touch", function(){
  $("#header_mobile_menu_wrp").toggle("drop"); 
  toggleBtn.toggleClass("change");
});

$(document).on("click touch", function(e){
  if( $("#header_mobile_menu_wrp").attr("style")=='display: block;'){
    $("#header_mobile_menu_wrp").toggle("drop");
    toggleBtn.toggleClass("change");
  }
})


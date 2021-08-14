function select_all() {
$('input[class=selected_data]:checkbox').each(function(){
if($('input[class=select-all]:checkbox:checked').length == 0){
    $(this).prop("checked", false);
} else {
    $(this).prop("checked", true);
}
}); 
}


$(document).on("click", ".deleteBtn", function() {
    $("#multi_delete").modal("show");
    var number_checkbox = $(".selected_data").filter(":checked").length;
    $("#count").html(number_checkbox);
    if(number_checkbox > 0){
        $(".delete_done").show();
        $(".check_delete").hide();
    }else{
        $(".delete_done").hide();
        $(".check_delete").show();
    }
});
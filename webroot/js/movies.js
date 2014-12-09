/**
 * Created by marko on 01/12/2014.
 */

function genres() {
    $(".genres-links").click(function() {
        var genre = $(this).attr("data-genre");
        $("#genre").val(genre);

        var newgenre = $("#genre").val();
        $(".genres-links").each(function(){
            var that = $(this);
            if(that.text() == newgenre) {
                that.addClass("selected");
            }
            else {
                that.removeClass("selected");
            }
        });

        /*
        $("#sokBtn").addClass("pending-search");

        setTimeout(function() {
            $("#sokBtn").removeClass("pending-search");
        }, 1500);
        */

        subMitForm();


    });

}

function sorting() {
    $(".sort-links").click(function(){
            var that = $(this);
            var col = that.attr("data-sort");
            var order = that.attr("data-order");

            if(order == "ASC"){
                that.attr("data-order", "DESC");
                that.find("span").attr("class", "arrow-down");
                $("#order_" + col).val("DESC");
            }
            else if(order == "DESC"){
                that.attr("data-order", "ASC");
                that.find("span").attr("class", "arrow-up");
                $("#order_" + col).val("ASC");
            }

            /*
            $("#sokBtn").addClass("pending-search");

            setTimeout(function() {
                $("#sokBtn").removeClass("pending-search");
            }, 1500);
            */

            subMitForm();

    });


}


function subMitForm() {
   $("#search-form").submit();
}

$(function() {
     genres();

     sorting();

});


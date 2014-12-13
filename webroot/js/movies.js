/**
 * Created by marko on 01/12/2014.
 */

function genres() {
    $(".genres-links").click(function() {
        var that = $(this);
        var genre = that.attr("data-genre");
        $("#genre").val(genre);

        /** UNSELECT **/
        if(that.hasClass("selected")){
            that.removeClass("selected");
            $("#genre").val("");
        }
        else {

            var newgenre = $("#genre").val();
            $(".genres-links").each(function () {
                var that = $(this);
                if (that.text() == newgenre) {
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
        }


    });

}

function sorting() {
    $(".sort-links").click(function(){
            var that = $(this);
            var col = that.attr("data-sort");
            var order = that.attr("data-order");

            $("#order_col").val(col);

            if(order == "ASC"){
                that.attr("data-order", "DESC");
                that.find("span").attr("class", "arrow-down");
                $("#order_dir").val("DESC");
            }
            else if(order == "DESC"){
                that.attr("data-order", "ASC");
                that.find("span").attr("class", "arrow-up");
                $("#order_dir").val("ASC");
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


function paging() {
    $(".paging-links-wrapper a").click(function () {
            var that = $(this);
            var value = that.attr("data-page");
            var page = $("input#page");
            var tempval = parseFloat(page.val());

            $(".paging-links-wrapper a").removeClass("selected");
            that.addClass("selected");

            if(value == "-1"){
               var v = tempval-1;
               page.val(v.toString());
            }
            else if(value == "+1"){
                var p = tempval+1;
                page.val(p.toString());
            }
            else {
                page.val(value);
            }

            subMitForm();
    });
}


function hitsperpage() {
    $("a.hits-per-page").click(function(){
        var that = $(this);
        $("a.hits-per-page").removeClass("selected");
        that.addClass("selected");
        var hitsperpage = that.attr("hits-per-page");
        $("#hits_per_page").val(hitsperpage);
        subMitForm();
    });


}

function clear() {
    $("#search-form").find("input[type='hidden']").val("");
    $("#search-form").find("input[type='text']").val("");
    $("#search-form").find("a").removeClass("selected");

}


function subMitForm() {
   $("#search-form").submit();
}

$(function() {
     genres();
     sorting();
     paging();
     hitsperpage();

     $("#clearBtn").click(function(){
         clear();
         return false;
     });



});


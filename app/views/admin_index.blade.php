@extends('layout')

@section('content')

    <h2>Admin</h2>

    <div id="admin-left-content">
        <ul>
          <li><a href="#1"> blog </a></li>
        </ul>
    </div>

    <div id="admin-main-content">
        <form id="admin-blog-form" action="adminblogsave" method="post">
            <input type="hidden" id="hidden-blogid" value="" >

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="" >
            </div>

            <div class="form-group">
                <label for="text">Text:</label>
                <textarea id="text" class="form-control" name="text"></textarea>
            </div>

            <input class="btn btn-default" type="submit" value="submit" >
        </form>

    </div>

    <script>
        $(function(){


            if ("onhashchange" in window) {

                window.onhashchange = function() {
                    var hash = parseFloat(window.location.hash.toString().replace("#", ""));

                    alert(hash);


                };


            }
            else {
                alert("You have a old browser! Die!");
            }


        });

    </script>


@stop
<!DOCTYPE html>
<html  ng-app="markos-blog" >
@include('includes.head')
<body>
    <div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Markos blog</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ URL::to('/') }}" >Home</a></li>
                    <li><a href="{{ URL::to('about') }}" >About</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div id="container">
      <div style="padding:40px 20%; ">
        @yield('content')
      </div>
    </div>
</body>
</html>
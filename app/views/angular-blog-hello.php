



<script>


    var MarkosBlog = angular.module("markos-blog", []);

    MarkosBlog.filter('unsafe', function($sce) {
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    });

    MarkosBlog.controller("blogController", function($scope, $http) {

        $scope.blog = [];

        var promise = $http.get("blogdata");
        promise.success(function(data){
            $scope.blog = data;
            $scope.iserror = false;
            $scope.singleblog = null;
            $scope.nosearchfound = false;
            $scope.initblog = [];
            $scope.search = "";
        });

        promise.error(function(data, status){
            $scope.iserror = true;
            $scope.errorstatus = status;
            $scope.errordata = data;
        });

        $scope.hideError = function() {
           $scope.iserror = false;
        };

        $scope.showSingleBlog = function(singleblog) {
            $scope.singleblog = singleblog;
        };

        $scope.isSingleBlogVisible = function() {
            return $scope.singleblog != null;
        };

        $scope.hideSingleBlog = function() {
           $scope.singleblog = null;
        };

        $scope.noSearchFound = function() {
            return $scope.nosearchfound;
        };


        $scope.resetSearch = function() {
             $scope.search = "";
             $scope.searchBlog();
        };

        $scope.searchBlog = function() {
            if($scope.search.length > 2){
                    var foundBlogs = $.map($scope.blog, function(val, i) {
                    if(val.Title.toLowerCase().indexOf($scope.search.toLowerCase()) > -1){
                        return val;
                    }
                });

                if(foundBlogs.length === 1){
                    $scope.singleblog = foundBlogs[0];
                    $scope.nosearchfound = false;
                }
                else if(foundBlogs.length > 1) {
                    $scope.initblog = $scope.blog;
                    $scope.blog = foundBlogs;
                    $scope.nosearchfound = false;
                }
                else {
                    $scope.initblog = $scope.blog;
                    $scope.blog = [];
                    $scope.nosearchfound = true;
                }
           }
           else if($scope.search === ""){
                if($scope.initblog.length > 0){
                    $scope.blog = $scope.initblog;
                    $scope.nosearchfound = false;
                }
                else {
                    window.location.reload();
                }
           }

        };

    });

</script>

<div id="blogControllerContainer" ng-controller="blogController" >



    <div class="search">
        <input type="text" id="search" name="search" value="" ng-model="search" ng-keyup="searchBlog()"  >
        <button ng-click="resetSearch()" >Reset</button>
    </div>

    <div class="alert alert-danger" role="alert" ng-show="iserror"  ng-click="hideError()" >
        <h4>{{ errorstatus }} </h4>
        <p>{{ errordata }}</p>
    </div>

    <div class="alert alert-warning" ng-show="noSearchFound()" >
        <p>No results found!</p>
    </div>

    <div class="jumbotron" ng-show="isSingleBlogVisible()" >
        <h3>{{ singleblog.Title }}</h3>
        <p ng-bind-html="singleblog.Text | unsafe" ></p>
        <br>
        <a ng-click="hideSingleBlog()" >Back</a>
    </div>

    <section class="well" ng-show="!isSingleBlogVisible()" ng-repeat="b in blog"  >
        <div>
            <h3><a ng-click="showSingleBlog(b)" >{{ b.Title }} </a></h3>
        </div>
    </section>





</div>



<?php

echo "Testing \n";



?>


<html lang="en" ng-app>
<head>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>

    <script type="text/javascript">

        lastmessage_num = 0;
        runagain = 0;
        $(function(){
            getFeed(lastmessage_num);

        });
        function getFeed(lastmessage_number){
            console.log("started getFeed");
            console.log("last mesage number:" + lastmessage_number);
            get_feed_link = 'getfeed.php' + '?lastmessage_number=' + lastmessage_number;
            $.getJSON(get_feed_link, function(data){

                if((data)){
                  //  console.log("inside getjson");
                $.each(data, function(i, field){
                    //console.log(i);
                    //console.log("should have outputted something");
                    console.log(field);
                    //$( "<p>" ).attr( "src", field.media.m ).appendTo( "#message");
                    $('div#main_board').append("<div class=message>field.board_id" + field.board_id + "<br /> from:" + field.from  + "<br /> to:" + field.to + "<br /> message:" + field.message + "</div><br />");
                    lastmessage_num = field.board_id;
                    //lastmessage_num = lastmessage_number;
                });

                    get_feed_func = 'getFeed(' + 0 + ')';
                    setTimeout(get_feed_func, 10000);
                }else{
                   runagain = 1;
                }

            });

            if(runagain==1){
                runagain = 0;
                console.log("running again");
                //get_feed_func = 'getFeed(' + lastmessage_num + ')';
                get_feed(lastmessage_num);

            }

        }

    </script>

</head>

<body>
<h1>Hello world, this is the morse code project</h1>

<br />

<div>
 	<p>Name : <input type="text" ng-model="name"></p>
 	<h1>Hello {{name}}</h1>
</div>

//<p>Nothing here {{'yet' + '!'}}</p>








<div ng-app="myApp" ng-controller="customersCtrl">

<table>
  <tr ng-repeat="x in names">
    <td>{{ x.board_id }}</td>
    <td>{{ x.from }}</td>
  </tr>
</table>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.get("localhost/getfeed.php")
    .then(function (response) {$scope.names = response.data.records;});
});
</script>







<br />


<div style = "border: 1px black solid; height: 2000px; width: 600px;"  id="main_board">

some stuff inside here

    <div id="message">Replace me</div>

</div>

</body>



</html>

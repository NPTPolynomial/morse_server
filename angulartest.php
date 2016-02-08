<!DOCTYPE html>
<html>
<style>

*{
	margin: 0 auto;
}

table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}


.loadingImg{
	/*background-image: url(img/hex-loader2.gif);
	
	animation: rotateSpinner 1.2s linear infinite;
	
	-webkit-animation: rotateSpinner 1.2s linear infinite;
	display: inline-block;
	*/
	vertical-align: middle;
	/*height: 24px;
	width: 24px*/
}

#loading_sign{
	text-align: center;
	
}

.board_display{
	margin-top: 30px;
	width: 700px;
}


</style>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>

<div class="board_display" ng-app="myApp" ng-controller="customersCtrl">

<table>
	<th>Board_id</th>
	<th>From</th>
	<th>Message Type</th>
	<th>To</th>
	<th>Dial_id</th>
	<th>Dial_message</th>
	
	<tr>
	<td id="loading_sign" class="loadingImg" colspan="6"><img src="img/hex-loader2.gif"></img></td>
	</tr>
	
	<tr ng-repeat="x in names">
		<td>{{ x.board_id }}</td>
		<td>{{ x.from }}</td>
		<td>{{ x.type }}</td>
		<td>{{ x.to }}</td>
		<td>{{ x.dial_id }}</td>
		<td>{{ x.dial_message }}</td>
	</tr>
</table>

</div>

<script>
var app = angular.module('myApp', []);

app.controller('customersCtrl', function($scope, $http, $interval) {


   $interval(function(){
    //$scope.message="This DIV is refreshed "+c+" time.";
    //c++;
    $http.get("getfeed.php")
    .then(function (response) {$scope.names = response.data;
	
		if(($scope.names)){
			document.getElementById("loading_sign").style.display = 'none';
		}
	
	});
	


  },10000);


});

// console.log($scope.names);
</script>

</body>
</html>

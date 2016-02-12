


<!DOCTYPE html>
<html>
<head>
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

#bubble_board{
	display: none;
	margin-top: 30px;
	width: 600px;
	height: 600px;
}

.message_left{
	width: 500px;
	height: 90px;
}

.message_right{
	width: 500px;
	height: 90px;
}

.message_arrow{
	width: 10px;
}

.message_body_left{
	width: 180px;	
	padding: 15px;
	float: left;


	-webkit-border-radius: 0px 77px 77px 77px;
	-moz-border-radius: 0px 77px 77px 77px;
	border-radius: 0px 77px 77px 77px;
	border: 4px solid #C4FFFF;
	background-color:#B0CDD9;
	-webkit-box-shadow: #B3B3B3 8px 8px 8px;
	-moz-box-shadow: #B3B3B3 8px 8px 8px;
	box-shadow: #B3B3B3 8px 8px 8px;
	
}


.message_body_right{
	width: 180px;	
	padding: 15px;
	float: right;

	-webkit-border-radius: 77px 0px 77px 77px;
	-moz-border-radius: 77px 0px 77px 77px;
	border-radius: 77px 0px 77px 77px;
	border: 4px solid #C4FFFF;
	background-color:#5FD9D5;
	-webkit-box-shadow: #B3B3B3 8px 8px 8px;
	-moz-box-shadow: #B3B3B3 8px 8px 8px;
	box-shadow: #B3B3B3 8px 8px 8px;
	
}


</style>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

</head>

<body>

<div class="board_display" ng-app="myApp" ng-controller="customersCtrl">

<table>
	<th>Date Time</th>
	<th>Board_id</th>
	<th>From</th>
	<th>Message Type</th>
	<th>End</th>
	<th>To</th>
	<th>Dial_id</th>
	<th>Dial_message</th>
	
	<tr>
	<td id="loading_sign" class="loadingImg" colspan="7"><img src="img/hex-loader2.gif"></img></td>
	</tr>
	
	<tr ng-repeat="x in names">
		<td>{{ x.datetime }}</td>
		<td>{{ x.board_id }}</td>
		<td>{{ x.from }}</td>
		<td>{{ x.type }}</td>
		<td>{{ x.end }}</td>
		<td>{{ x.to }}</td>
		<td>{{ x.dial_id }}</td>
		<td>{{ x.dial_message }}</td>
	</tr>
</table>



<div id="bubble_board">
	
	<h2> Hi, this is the bubble board </h2>
	<br />
	
	<div ng-repeat="x in names">
		
		<div ng-if="x.end == 0">
		<div class="message_left">
			<div class="message_arrow">
				
			</div>
			
				<div class="message_body_left">
					<td>{{ x.datetime }}</td>
					<td>{{ x.board_id }}</td>
					<b>{{ x.from }}:</b>
					<!--<td>{{ x.type }}</td>
					<td>{{ x.end }}</td>-->
					<i>@{{ x.to }} </i>
					<!--<td>{{ x.dial_id }}</td>-->
					<td>{{ x.dial_message }}</td>
				</div>
			</div>
			
		</div>
		
		
		
		
		
		
		
		<div ng-if="x.end == 1">
		<div class="message_right">
			<div class="message_arrow">
				
			</div>
			
				<div class="message_body_right">
					<td>{{ x.datetime }}</td>
					<td>{{ x.board_id }}</td>
					<b>{{ x.from }}:</b>
					<!--<td>{{ x.type }}</td>
					<td>{{ x.end }}</td>-->
					<i>@{{ x.to }} </i>
					<!--<td>{{ x.dial_id }}</td>-->
					<td>{{ x.dial_message }}</td>
				</div>
			
		</div>
		
		
		
		
		
		
		
		<div style="clear: both;"></div>

	</div>
	
</div>


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
			document.getElementById("bubble_board").style.display = 'block';
		}
	
	});
	


  },10000);


});

// console.log($scope.names);
</script>

</body>
</html>

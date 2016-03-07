


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/moment-timezone.js"></script>

<script>
// Button functionality
function sendFromTo(from,to,type,end,network){
	
	console.log("Entered sendFromTo: " + from +" "+ to +" "+ type +" "+ end +" "+ network);
	dial_id = 1;
	if(type=='message'){
		dial_id = 9;
	}else if(type=='bye'){
		dial_id = 41;
	}else{
		dial_id = 1;
	}
	
	$.ajax({
		url: 'send.php',
		data: 'from='+from+'&to='+to+'&type='+type+'&dial_id='+dial_id+'&count=1&end='+end+'&network='+network,
		type: 'GET',
		dataType: 'json',
		success: function(response){
			console.log("Successfully sent ");
			$("return_message").html("<p>Successfully Sent</p>");
		},
		error: function(e){
			console.log("Response: ");
			console.log(e.responseText);
			$("return_message").html("<p>Failed Sent" + e + "</p>");
		}
		
	});		
}

</script>


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
	<th>Count</th>
	<th>Network</th>
	
	<tr>
	<td id="loading_sign" class="loadingImg" colspan="10"><img src="img/hex-loader2.gif"></img></td>
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
		<td>{{ x.count }}</td>
		<td>{{ x.network }}</td>
	</tr>
</table>

<br />
<form action="truncate_all_tables.php" method="POST">
  <fieldset>
	<input class="button-primary" type="submit" value="Clear All Tables">
  </fieldset>
</form>

<button onclick=sendFromTo('a','b','hello','0','1')>A1: Send Hello 0</button>
<button onclick=sendFromTo('a','b','hello','1','1')>A1: Send Hello 1</button>
<button onclick=sendFromTo('a','b','message','0','1')>A1: Send MSG 0</button>
<button onclick=sendFromTo('a','b','message','1','1')>A1: Send MSG 1</button>
<button onclick=sendFromTo('a','b','bye','0','1')>A1: Send Bye 0</button>
<button onclick=sendFromTo('a','b','bye','1','1')>A1: Send Bye 1</button>
<br />
<button onclick=sendFromTo('b','a','hello','0','1')>B1: Send Hello 0</button>
<button onclick=sendFromTo('b','a','hello','1','1')>B1: Send Hello 1</button>
<button onclick=sendFromTo('b','a','message','0','1')>B1: Send MSG 0</button>
<button onclick=sendFromTo('b','a','message','1','1')>B1: Send MSG 1</button>
<button onclick=sendFromTo('b','a','bye','0','1')>B1: Send Bye 0</button>
<button onclick=sendFromTo('b','a','bye','1','1')>B1: Send Bye 1</button>
<br />
<br />
<button onclick=sendFromTo('a','b','hello','0','2')>A2: Send Hello 0</button>
<button onclick=sendFromTo('a','b','hello','1','2')>A2: Send Hello 1</button>
<button onclick=sendFromTo('a','b','message','0','2')>A2: Send MSG 0</button>
<button onclick=sendFromTo('a','b','message','1','2')>A2: Send MSG 1</button>
<button onclick=sendFromTo('a','b','bye','0','2')>A2: Send Bye 0</button>
<button onclick=sendFromTo('a','b','bye','1','2')>A2: Send Bye 1</button>
<br />
<button onclick=sendFromTo('b','a','hello','0','2')>B2: Send Hello 0</button>
<button onclick=sendFromTo('b','a','hello','1','2')>B2: Send Hello 1</button>
<button onclick=sendFromTo('b','a','message','0','2')>B2: Send MSG 0</button>
<button onclick=sendFromTo('b','a','message','1','2')>B2: Send MSG 1</button>
<button onclick=sendFromTo('b','a','bye','0','2')>B2: Send Bye 0</button>
<button onclick=sendFromTo('b','a','bye','1','2')>B2: Send Bye 1</button>
                                
<p id='return_message'></p>


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
    $http.get("getfeed.php?network=2")
    .then(function (response) {$scope.names = response.data;
		if(($scope.names)){
			
			$scope.names.forEach(function(name) {
			    //console.log(name.datetime);

				name.datetime = moment(moment.utc(name.datetime).toDate()).format('YYYY-MM-DD HH:mm:ss');
				//console.log("New time: " + name.datetime);
			  });
		
			document.getElementById("loading_sign").style.display = 'none';
			document.getElementById("bubble_board").style.display = 'block';
		}
	
	});
	


  },1000);


});

// console.log($scope.names);
</script>

</body>
</html>

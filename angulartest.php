<!DOCTYPE html>
<html >
<style>
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
</style>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="customersCtrl">

<table>
	<th>Board_id</th>
	<th>from</th>
	<th>message</th>
	<th>to</th>
	<th>dial_id</th>
	<th>dial_message</th>
	
  <tr ng-repeat="x in names">
    <td>{{ x.board_id }}</td>
    <td>{{ x.from }}</td>
	<td>{{ x.message }}</td>
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
    .then(function (response) {$scope.names = response.data;});

  },10000);


});

// console.log($scope.names);
</script>

</body>
</html>

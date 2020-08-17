<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style media="screen">
ul{
	list-style: none;
}

h2{
	color:lightblue;
}


</style>
</head>
<body>

<h2>Chat message</h2>
<ul>
@foreach($name as $value)
<li><strong>{{ $value -> user->name}}</strong></li>
<li>{{ $value->message }}</li>
<li>{{ $value->created_at }}</li><hr>
@endforeach

</ul>

</body>
</html>

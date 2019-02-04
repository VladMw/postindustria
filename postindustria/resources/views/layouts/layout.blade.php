@section("header")
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>VPN Agency</title>
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
        <meta name="_csrf" content="{{ csrf_token() }}">
</head>
<body>
	<nav class="top-menu">
		<ul>
                    <li class="pagination">Companies</li>
                    <li class="pagination">Users</li>
                    <li class="pagination">Abusers</li>
		</ul>
	</nav>
@show

@section("body")
@show

@section("footer")
        <script type="text/javascript" src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/main.js') }}"></script>
</body>
</html>
@show
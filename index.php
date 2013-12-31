<!DOCTYPE html>
<html>
<head>
<title>Find a moment</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" media="all" />
<link rel="stylesheet" type="text/css" href="bootstrap/tagsinput/bootstrap-tagsinput.css" media="all" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/tagsinput/bootstrap-tagsinput.js"></script>
<!-- <script type="text/javascript" src="bootstrap/tagsinput/bootstrap-tagsinput-angular.js"></script> -->
<script type="text/javascript" src="script.js"></script>
<style>
#moments { list-style: none; width: 190px; }
#moments li { 
	float: left;
	border-bottom: 1px solid #c2c2c2; 
	margin-bottom: 2px;
}
#peoples { list-style: none; }
.holder {
	margin: 2px; 
	border-bottom: 1px solid #c2c2c2; 
	padding-bottom: 10px;
}
</style>
</head>
<body>
<!-- <div id="fb-root"></div> -->
<div id="fb-root"></div>
<div id="wrapper">
	<div class="cleaner">
		<div class="leftbar" style="border-right: 1px solid #c2c2c2">
			<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
			<div style="margin-top: 5px" class="downblock">
				<h4>moments</h4>
				<ul id="moments" style="margin:0;padding:0;"></ul>
				<a href="#" id="new_moment">new</a>
				<input type="text" value="" name="newmoment" style="display: none; width: 191px" />
			</div>
		</div>
		<div id="container">
		<h3 style="text-align:center">Find people in a moment</h3>
		<form action="" id="mainform" method="post">
		<input type="text" value="" data-role="tagsinput" placeholder="Add tags" id="labels" />			
		<button id="parse" class="btn" style="margin-left: -5px;">parse</button>
		</form>
		<ul id="peoples"></ul>
	</div>
	</div>
</div>

<!-- <a href="http://timschlechter.github.io/bootstrap-tagsinput/examples/">tags input bootstrap</a> -->

</body>
</html>
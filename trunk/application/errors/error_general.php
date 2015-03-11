<!doctype html>
<meta charset="utf-8"> 
<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport"> 
<title>Error</title> 
<style>
.page_error {
  padding:150px 0;
}
.page_404 {
  padding:150px 0;
  text-align:center;
}
.page {
  background:transparent;
  height:100%;
  margin-left:auto;
  margin-right:auto;
  max-width:1044px;
  padding-left:1.5em;
  padding-right:1.5em;
}
img {
  width:auto;
  border:0;
  vertical-align:middle;
}
h3 {
  color:#696059;
  font-family:'Courier', serif;
  font-size:21px;
  font-stretch:normal;
  font-style:normal;
  font-variant:normal;
  font-weight:400;
  line-height:normal;
  margin:1em 0;
}
p {
  color:#696059;
  font-family:'Courier', serif;
  font-size:12px;
  font-stretch:normal;
  font-style:normal;
  font-variant:normal;
  font-weight:400;
  line-height:normal;
  margin:1em 0;
}
.page_error a, .page_404 a {
  display:inline-block;
  vertical-align:middle;
  width:30%;
  zoom:1;
}
.button-orange {
  background:#ED542B;
  color:#FFFFFF;
  font-family:'Open Sans', serif;
  font-size:13px;
  font-stretch:normal;
  font-style:normal;
  font-variant:normal;
  font-weight:700;
  line-height:normal;
  padding:15px;
  text-align:center;
  text-transform:uppercase;
}
a {
  text-decoration:none;
}
::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }
</style>
<body>
	<div class="page_error">
		<div class="page">
			<h3><?php echo $heading; ?></h3>
			<p><?php echo $message; ?></p>
		</div>
	</div>
</body>
</html>
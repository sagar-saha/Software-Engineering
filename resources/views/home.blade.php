<?php
$i=0;
$total=0;
$ta="";
if(sizeof($data)>0){
          foreach($data as $d){
		$date=$d->dat;
		$da=explode("-",$date);
		
		   $dta[$i] ="{dat:".$da[0].",profit:".$d->profit."}, ";
$total=$total+$d->profit;
$i++;
		  }
		  foreach($dta as $key=>$value) { 
$ta = implode($dta); 
}
}
		  ?>
<html>
<head>
<title>Drug Mart</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<script src="js/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href='//fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<style>
#tot{
	width:15%;
	padding-left: .5cm;
	color:white;
	background-color: #ff6c5f;
	font-size: 24px;
	border-radius: 25px;
}
#to{
	width:15%;
	padding-left: .5cm;
	color:white;
	background-color: white;
	font-size: 24px;
	border-radius: 25px;
}
#cen{
	padding-left: 24cm;
	font-size: 24px;
	border-radius: 25px;

}
</style>

</head>
<body>
<div class="header">
   <div class="header_top">	
      <div class="container"> 
             <div class="logo">
				<h1><a href="index.html">Drug Mart</a></h1>
			 </div>
			 <nav class="navbar navbar-default menu" role="navigation"><h3 class="nav_right"><a href="index.html"><h1><a href="index.html">Drug Expo</a></h1></a></h3>
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav menu1">
			      	<!--<li class="active"><a href="#home" class="scroll"> <span> </span><i class="menu-border"></i></a></li>-->
			        <li><a href="home" class="scroll">Dashboard</a></li>
			        <li><a href="add-product" class='scroll'>Add New</a></li>
			        <li><a href="sell" class="scroll">Sell</a></li>
			        <li><a href="stat">Products</a></li>
			       </ul>
			       <ul class="login">
				   	 <li><a href="../logout">
                                            [Logout]
                                        </a></li>
				   	 
				   	 <div class="clearfix"></div>
				   </ul>
				   <form class="navbar-form navbar-left search1" role="search">
			        <div class="search2">
					  <form>
						 <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
						 <input type="submit" value="">
					  </form>
					</div>
			       </form>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
			
		 </div>  
	   
	   
	    </div>
		<div class="container" style="margin-top:100px;"></div>
		<div class="container">
  <div class="row text-center">
    <div class="col-sm-8">
      <div id="chart"></div>
    </div>
	 <div class="col-sm-4" id="to">
    </div>
    <div class="col-sm-4" id="tot">
     Total Profit</br>This Month</br> <?php echo $total." Taka"; ?>
    </div>
	<div class="span12" id="cen">
     <a href="../profile"><p style="color:#2196f3;">Profile</p></a>
    </div>	
	<div class="span12" id="cen">
     <a href="../pay"><p style="color:#2196f3;">Pay Us!</p></a>
    </div>
  </div>
		
	
		

</body>
</html>	
<script>

Morris.Bar({
 element : 'chart',
 data:[<?php echo $ta; ?>],
 xkey:'dat',
 ykeys:['profit'],
 labels:['Total Profit'],
 hideHover:'auto',
 stacked:true
});

</script>	
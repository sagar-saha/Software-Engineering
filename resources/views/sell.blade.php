
<html lang="en">
<head>
  <meta charset="utf-8">
<title>Drug Mart</title>
<link href="http://bmp3.us/store/css/bootstrap.css" rel='stylesheet' type='text/css' />

<script src="http://bmp3.us/store//js/jquery-1.11.1.min.js"></script>


<link href="http://bmp3.us/store/css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href='//fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	
<script type="text/javascript">
var total=0;
var i=0;
var pro = [];
var cou = [];
     $(document).ready(function () {

      $('#scriptBox').autocomplete({


          source:'{!!URL::route('autocomplete')!!}',

          minlength:1,
          autoFocus:true,
          select: function(event, ui) {
      $('#scriptBox').val(ui.item.value);
    }

      });


   });
function runScript(e) {
 
    if (e.keyCode == 13) {
        e.preventDefault();
        var tb = document.getElementById("scriptBox").value;
       if (tb != null) {
        var person = prompt("Please enter the quantity", "1");
        
    if (person != null) {
        var price = prompt("Please enter the price", "10");
var token=document.getElementById("_token").value;
table(tb,person,price,token);
    }
}
    }

function table(tb,person,price,token){
	update_db(tb,person,price,token);
document.getElementById("butt").innerHTML ="<input type='button' onclick='tot()' class='btn btn-success pull-right btn-lg' value='Done'>";

var tr = document.createElement('TR');
    var td = document.createElement('TD');
    var td1 = document.createElement('TD');
var td2 = document.createElement('TD');
var pri=person*price;
    td.appendChild(document.createTextNode(tb));
    td1.appendChild(document.createTextNode(person+" pice"));
td2.appendChild(document.createTextNode(pri+" taka"));
    tr.appendChild(td);
    tr.appendChild(td1);
tr.appendChild(td2);
    document.getElementById("TABLE").appendChild(tr);
document.getElementById("scriptBox").value = "";
total=total+pri;
i=i+1;
pro[i]=tb;
cou[i]=person;
}

}
function update_db(tb,person,price,token){
	$.ajax({
		type:"post",
		url :"<?= URL::to('ajax/add') ?>",
		 dataType: "json",
		 data:{
			 'name':tb,
			 'quantity':person,
			 'price':price,
			 '_token':token,
		 },
		 success:function(data){
			 console.log(data);
		 }
		
	});
	
}
function t(){
	
	window.location.href = "/sell";
}
function tot(){

for(i=0;i<3;i++){
if(i==2){
var tr = document.createElement('TR');
    var td = document.createElement('TD');
    var td1 = document.createElement('TD');
var td2 = document.createElement('TD');

    td.appendChild(document.createTextNode(""));
    td1.appendChild(document.createTextNode("Total Bill"));
td2.appendChild(document.createTextNode(total+" taka"));
    tr.appendChild(td);
    tr.appendChild(td1);
tr.appendChild(td2);
    document.getElementById("TABLE").appendChild(tr);

}
else{
var tr = document.createElement('TR');
    var td = document.createElement('TD');
    var td1 = document.createElement('TD');
var td2 = document.createElement('TD');

    td.appendChild(document.createTextNode(" "));
    td1.appendChild(document.createTextNode(""));
td2.appendChild(document.createTextNode("."));
    tr.appendChild(td);
    tr.appendChild(td1);
tr.appendChild(td2);
    document.getElementById("TABLE").appendChild(tr);
}
}
document.getElementById("butt").innerHTML ="<input type='button' onclick='t()' class='btn btn-info pull-right btn-lg' value='Complete Order!'>";
}

function getcount(str,str2) {
    
   
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str+ "&u="+ str2, true);
        xmlhttp.send();
    
}
</script>
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
<form method="POST">
<h3></h3>

 <div class="col-md-10 col-md-offset-1">
    <input type="text" id="scriptBox" class="form-control" name='country' value='' placeholder="Search" onkeypress="return runScript(event)">
	<input type="hidden" id="_token" name="_token" value="<?= csrf_token(); ?>">
    </div>

</form>
<div class="container">
<table id="TABLE" class="table">
<thead class="thead-dark">
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>

</tbody>
</table>
<div id="butt"></div>
</div>
</html>		
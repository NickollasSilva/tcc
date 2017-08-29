<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $title;?></title>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
		
	<style type="text/css">
		.navbar {
      		margin-bottom: 0;
      		border-radius: 0;
   		}
   		h3{
   			margin-top: 0;
   			color:black;
   			text-align: center;
   		}
		.row.content {height: 1500px}
		.sidenav {
	    	padding-top: 20px;
		    background-color: #8888CE;
		    height: 100%;
    	}
    	.banner {
		    background-color: #8888CE;
		    width: 100%;
    	}
        @media screen and (max-width: 767px) {
        	.sidenav {
        		height: auto;
        		padding: 15px;
      		}
        	.row.content {height: auto;} 
        }
        .btn-group-vertical{
        	width: 100%;        	
        }
        
        .btn-primary{
        	padding: 10px;
        	font: 18px arial, sans-serif;
        	color: black;
        	background-color: #CDC1FF;
        	border-color: black;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary{
        	padding: 10px;
        	font: 18px arial, sans-serif;
        	color: black;
        	border-color: black;
        	background-color: #A89DF2;
        }
        .btn:focus, .btn:active:focus, .btn.active:focus{
        	padding: 10px;
        	font: 18px arial, sans-serif;
        	color: black;
        	border-color: black;
        	background-color: #8888CE;
        }
        
        body{
        	background-color: #EBE5FF;
        	word-wrap: break-word;
        	font-family: 'Montserrat', sans-serif;
        }
        footer {
	    	background-color: #555;
	        color: white;
	        padding: 15px;
	    }
	</style>
</head>
<body>
	
	<div class="banner container-fluid">
		 <img src="<?php echo base_url(); ?>static/placeholderbanner.png">
	</div>
	
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="<?php echo base_url();?>"><p class="navtext">VGM Edits</p></a>
	    </div>
	    <ul class="nav navbar-nav">
	    	<li><a href="#"><font class="navtext">About</font></a></li>
	      	<li><a href="#"><font class="navtext">Contact</font></a></li>
	      	<li><a href="<?php echo base_url() . 'forums/index.php';?>"><font class="navtext">What's Happening Forum?</font></a></li>
	      	<li><a href="#"><font class="navtext"></font></a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	    <?php if (isset($_SESSION['cd_Level'])):?>
			<li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span>  Options
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">	
		        	<li class="dropdown-header"><?php echo $_SESSION['cd_Login']; ?></li>	        	
			        <li><a href="<?php echo site_url('games/insert'); ?>">Insert Game</a></li>			
			        <li class="divider"></li>        	
		        	<li class="dropdown-header">Game Options</li>
			        <?php if(!empty($game)):?>
				        <li><a href="
						<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game'] . '/edit'); ?>">Edit Game</a></li>
				        <li><a href="
						<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game'] . '/insertsf'); ?>">Insert Soundfile</a></li>		          
				        <li><a href="
						<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game'] . '/editsf'); ?>">Edit Soundfiles</a></li>
				    	<li><a href="
						<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game'] . '/delete'); ?>">Delete Game</a></li>
						<li><a href="
						<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game']); ?>">Go to gamepage</a></li>
				    <?php endif; ?>
		        </ul>
		    </li>
		<?php endif; ?>
		    <?php if (!isset($_SESSION['cd_Level'])):?>
	      		<li><a href="<?php echo site_url('games/login?lurl=' . uri_string()); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	    	<?php else: ?>
	    		<li><a href="<?php echo site_url('games/logout?lurl=' . uri_string()); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	    	<?php endif; ?>
	    </ul>	    
	  </div>
	</nav>
	
    <div class="container-fluid">
    <div class="row content">
    	<div class="col-sm-2 sidenav">
    		<h3>Platforms</h3>
    		 <div class="btn-group-vertical">
    		 	<?php foreach ($platforms as $platform_item): ?>
					<a href="<?php echo site_url('games/' . $platform_item['cd_Platform']);?>" type="button" class="btn btn-primary">						
						<?php echo $platform_item['ds_Name']; ?>						
					</a>
				<?php endforeach; ?>
			</div>
      		
      		<br><br>
	        <div class="input-group">
	        	<input type="text" class="form-control" placeholder="Search...">
	        	<span class="input-group-btn">
	          	<button class="btn btn-default" type="button">
	            	<span class="glyphicon glyphicon-search"></span>
	       		</button>
	        	</span>
	      	</div>
    	</div>

	    <div class="col-sm-10">
	    

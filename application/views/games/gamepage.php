<style>
	.panel{
		margin-top:3%;
		background-color: #CDC1FF;
	}
	.panel-heading{
		height: 200px;
		
	}
	.img-thumbnail{
		height:180px;
		width:200px;
		
	}
	.info{
		
		padding-right:20%;
		
	}
	.table-bordered{
		table-layout: fixed;
		background-color: #EBE5FF;
        	
	}
	.tleft{
		text-align:left;
		width:50%;
		word-wrap: break-word;
	}
	
	.tright{
		text-align:center;
		word-wrap: break-word;
	}
	
	.desc{
		margin-top: 0px;
	}
	
	.cont{
		margin-bottom:0.5%;
	}
	
	h3{
		margin-bottom:5%;
	}
</style>

<br>
<a href="<?php echo site_url('games/' . $game['cd_Platform']); ?>">Go to platform</a>

<div class="container">

<div class="cont panel panel-default">
	<div class="panel-body" style="text-align: center;">
		<div class="col-sm-4">
			<img class="img-thumbnail center-block" src="<?php echo base_url(); ?>files/images/<?php echo $game['lk_Image']?>" />
			
		</div>	
		<div class="col-sm-8 info">
			<h3><?php echo $game['ds_Name']?></h3>	
			<table class="table table-bordered">
			    <tbody>
			      <tr>
			        <td class="tleft">Year:</td>
			        <td class="tright"><?php echo $game['ds_Year']?></td>
			      </tr>
			      <tr>
			        <td class="tleft">Developer:</td>
			        <td class="tright"><?php echo $game['ds_Developer']?></td>
			      </tr>
			      <tr>
			        <td class="tleft">Composer:</td>
			        <td class="tright"><?php echo $game['ds_Composer']?></td>
			      </tr>
			    </tbody>
			</table>
		</div>
	</div>
</div>

<div class="desc panel panel-default">
	<div class="panel-body" style="text-align: center;">
		<?php echo $game['ds_Description']?>
	</div>
</div>


<br>


</div>
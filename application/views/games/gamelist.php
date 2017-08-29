<div class="container-fluid">
<style>
	.panel{
		margin:10px;
		margin-left:2.273%;
		margin-right:2.273%;
		text-align: center;
		background-color: #CDC1FF;
		color: black;
		height: 250px;
		width: 20%;
		border: 1px solid black;

	}
	.panel-title{
		margin-top:10px;
		height: 40px;
		font-size: 14px;
	}
	.img-thumbnail{
		display: block;
	    margin-left: auto;
    	margin-right: auto;
    	margin-top:15px;
    	height: 150px;
    	width: 150px;
	}
</style>

<br>
	<div class="btn-group btn-group-justified">
 		<?php for($i = 65; $i <= 90; $i++):?>
 			<a href="<?php echo site_url('games/' . $platform . '/' . chr($i));?>" class="btn btn-primary">
 				<?php echo chr($i);?>
 			</a>
 		<?php endfor;?>
	</div>
<br>

<?php foreach ($games as $games_item): ?>
	<a href="<?php echo site_url('games/' . $games_item['cd_Platform'] . '/' . $games_item['cd_Game']);?>">
		<div class="panel panel-default col-sm-3">			
			<div class="panel-title"><p><?php echo $games_item["ds_Name"] ?></p></div>
			<div class="panel-body">
				<img src="<?php echo base_url(); ?>files/images/<?php echo $games_item['lk_Image']?>"
				class="img-thumbnail">
			</div>
		</div>
	</a>
	
				
<?php endforeach; ?>

</div>

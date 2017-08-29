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
	
	.submit{
		margin:auto;
		display: block;
	}
	
	h3{
		margin-bottom:5%;
	}
	
	input, button{
		display:inline-block;
	}
</style>
<script>
	$(document).ready(function(){
		var origYearVal = $(".yearInput").val();
		var origDevVal = $(".devInput").val();
		var origCompVal = $(".compInput").val();
		var origNameVal = $(".nameInput").val();
		
		$(".yearEdit").click(function(){
			if($(".yearInput").attr("type") === "hidden"){
				$(".yearVal").hide();
				$(".yearInput").attr("type", "input");
			} else {
				$(".yearVal").show();
				$(".yearInput").attr("type", "hidden");
				$(".yearInput").val(origYearVal)
			}
		});

		$(".devEdit").click(function(){
			if($(".devInput").attr("type") === "hidden"){
				$(".devVal").hide();
				$(".devInput").attr("type", "input");
			} else {
				$(".devVal").show();
				$(".devInput").attr("type", "hidden");
				$(".devInput").val(origDevVal)
			}
		});

		$(".compEdit").click(function(){
			if($(".compInput").attr("type") === "hidden"){
				$(".compVal").hide();
				$(".compInput").attr("type", "input");
			} else {
				$(".compVal").show();
				$(".compInput").attr("type", "hidden");
				$(".compInput").val(origCompVal)
			}
		});

		$(".descEdit").click(function(){
			if($(".descInput").attr("type") === "hidden"){
				$(".descVal").hide();
				$(".descInput").attr("type", "textarea");
			} else {
				$(".descVal").show();
				$(".descInput").attr("type", "hidden");
				$(".descInput").val(origDescVal)
			}
		});

		$(".nameEdit").click(function(){
			if($(".nameInput").attr("type") === "hidden"){
				$(".nameVal").hide();
				$(".nameInput").attr("type", "input");
			} else {
				$(".nameVal").show();
				$(".nameInput").attr("type", "hidden");
				$(".nameInput").val(origNameVal)
			}
		});

		$(".imageEdit").click(function(){
			if($(".imageInput").attr("type") === "hidden"){
				$(".imageVal").hide();
				$(".imageInput").attr("type", "file");
			} else {
				$(".imageVal").show();
				$(".imageInput").attr("type", "hidden");
				
			}
		});
	});
</script>
<br>
<a href="<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game']); ?>">Go to gamepage</a>

<?php echo validation_errors(); ?>

<?php echo $error; ?>

<?php echo form_open_multipart('games/' . $game['cd_Platform'] . '/'. $game['cd_Game'] . '/edit'); ?>

<div class="container">

<div class="cont panel panel-default">
	<div class="panel-body" style="text-align: center;">
		<div class="col-sm-4">
			<img class="img-thumbnail center-block imageVal" src="<?php echo base_url(); ?>files/images/<?php echo $game['lk_Image']?>" />
			<input type="hidden" class="imageInput" name="image" size="20" required/>
	        <button type="button" class="glyphicon glyphicon-cog imageEdit"></button>
		</div>	
		<div class="col-sm-8 info">
			<h3>
				<span class="nameVal"><?php echo $game['ds_Name']?></span>
	        	<input class="nameInput" type="hidden" name="name" value="<?php echo $game['ds_Name']?>">
	        	<button type="button" class="glyphicon glyphicon-cog nameEdit"></button>
        	</h3>
			<table class="table table-bordered">
			    <tbody>
			      <tr>
			        <td class="tleft">Year:</td>
			        <td class="tright">
			        	
			        	<span class="yearVal"><?php echo $game['ds_Year']?></span>
			        	<input class="yearInput" type="hidden" name="year" value="<?php echo $game['ds_Year']?>">
			        	<button type="button" class="glyphicon glyphicon-cog yearEdit"></button>
			        	</div>
			        </td>
			      </tr>
			      <tr>
			        <td class="tleft">Developer:</td>
			        <td class="tright">
			        	<span class="devVal"><?php echo $game['ds_Developer']?></span>
			        	<input class="devInput" type="hidden" name="developer" value="<?php echo $game['ds_Developer']?>">
			        	<button type="button" class="glyphicon glyphicon-cog devEdit"></button>			        
			        </td>
			      </tr>
			      <tr>
			        <td class="tleft">Composer:</td>
			        <td class="tright">
						<span class="compVal"><?php echo $game['ds_Composer']?></span>
			        	<input class="compInput" type="hidden" name="composer" value="<?php echo $game['ds_Composer']?>">
			        	<button type="button" class="glyphicon glyphicon-cog compEdit"></button>		
			        	
			        </td>
			      </tr>
			    </tbody>
			</table>
		</div>
	</div>
</div>

<div class="desc panel panel-default">
	<div class="panel-body" style="text-align: center;">
		<span class="descVal"><?php echo $game['ds_Description']?></span>
        <input class="descInput" type="hidden" name="description" value="<?php echo $game['ds_Description']?>">
        <button type="button" class="glyphicon glyphicon-cog descEdit"></button>	
	</div>
</div>

<div class="container-fluid">
	<div class="col-sm-4">
		<label for="platform">Platform:</label>
	  	<select class="form-control" name="platform">
   			<?php foreach ($platforms as $platform_item): ?>
   				<option value="<?php echo $platform_item['cd_Platform']; ?>" 
				<?php if($platform_item['cd_Platform'] === $game['cd_Platform']) echo "selected";?>>
   					<?php echo $platform_item['ds_Name']; ?>
   				</option>
   			<?php endforeach; ?>
		</select>
	</div>
	<div class="col-sm-4">
		<h2><input class="submit" type="submit" name="submit" value="Edit Game" /></h2>
	</div>
</div>

<br>


</div>

</form>
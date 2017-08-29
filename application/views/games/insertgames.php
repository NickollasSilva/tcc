<script>
$(document).ready(function(){
	$(".alertname").hide();
	$(".alertyear").hide();
	$(".alertdeveloper").hide();
	$(".alertcomposer").hide();
	$(".alertdescription").hide();
    $(".name").blur(function(){
    	if($(".name").val().length > 49){
    		$(".name").val($(".name").val().substring(0,49));
    		$(".alertname").fadeIn();
    	}
    }); 

    $(".developer").blur(function(){
    	if($(".developer").val().length > 49){
    		$(".developer").val($(".developer").val().substring(0,99));
    		$(".alertdeveloper").fadeIn();
    	}
    });

    $(".composer").blur(function(){
    	if($(".composer").val().length > 49){
    		$(".composer").val($(".composer").val().substring(0,99));
    		$(".alertcomposer").fadeIn();
    	}
    });

    $(".description").blur(function(){
    	if($(".description").val().length > 499){
    		$(".description").val($(".description").val().substring(0,499));
    		$(".alertdescription").fadeIn();
    	}
    });
    
    $(".year").blur(function(){    	
    	var isnum = /^\d+$/.test($(".year").val());
    	if(isnum){
	    	if($(".year").val().length > 4){
	    		 
	    		$(".year").val($(".year").val().substring(0,4));
	    		$(".alertyear").fadeIn();
	    	}  else
	    	if($(".year").val().length < 4){
	    		var val = $(".year").val();
	    		for(i = 0; i < 4 - $(".year").val().length; i++){
	    			val = '0'.concat(val);
	    		}
	    		$(".year").val(val);
	    		$(".alertyear").fadeIn();
	        }
    	} else {
    		$(".year").val("0000");
    		$(".alertyear").fadeIn();
    	}
    }); 
});
</script>

<div class="container">
<h2><?php echo $title; ?></h2>
<br>

<?php if(!empty($success)):?>
	<h4>Game successfully inserted, <a href="<?php echo $success; ?>">go to gamepage</a></h4>
<?php endif; ?>

<div class="alert alert-danger alertname">
  The name field must contain <strong>less than 50</strong> characters!
</div>

<div class="alert alert-danger alertyear">
  The year field must contain <strong>exactly 4 numbers!</strong>
</div>

<div class="alert alert-danger alertdeveloper">
  The developer field must contain <strong>less than 100</strong> characters!
</div>

<div class="alert alert-danger alertcomposer">
  The composer field must contain <strong>less than 100</strong> characters!
</div>
<div class="alert alert-danger alertdescription">
  The description field must contain <strong>less than 500</strong> characters!
</div>



<?php echo validation_errors(); ?>

<?php echo $error; ?>

<?php echo form_open_multipart('games/insert'); ?>
    <div class="form-group">
    	<label for="name">Name</label>
    	<input type="input" class="form-control name" name="name" placeholder="Ex: The Flintstones: The Rescue of Dino & Hoppy" required/>
    </div>
    
    <div class="form-group">
		<label for="platform">Platform:</label>
	  	<select class="form-control" name="platform">
   			<?php foreach ($platforms as $platform_item): ?>
   				<option value="<?php echo $platform_item['cd_Platform']; ?>">
   					<?php echo $platform_item['ds_Name']; ?>
   				</option>
   			<?php endforeach; ?>
		</select>
	</div>
	
	<div class="form-group">
    	<label for="year">Year</label>
    	<input type="input" class="form-control year" name="year" placeholder="Ex: 1991" required/>
    </div>
	
	<div class="form-group">
    	<label for="developer">Developer</label>
    	<input type="input" class="form-control developer" name="developer" placeholder="Ex: Taito" required/>
    </div>
    
    <div class="form-group">
    	<label for="composer">Composer</label>
    	<input type="input" class="form-control composer" name="composer" placeholder="Ex: Yasuko Yamada, Naoto Yagishita" required/>
    </div>
    
        
	<div class="form-group">
	    <label for="description">Description</label>
	    <textarea class="form-control description" name="description" placeholder="Ex: The Flintstones: The Rescue of Dino & Hoppy is a 1991 platform video game developed by Taito for the Nintendo Entertainment System based on the animated series The Flintstones.
		" required></textarea><br />
	</div>
	
	<div class="form-group">
		<label for="image">Image</label>
		<input type="file" name="image" size="20" required/>
	</div>
	<br>

    <input type="submit" name="submit" value="Insert" />

</form>
</div>
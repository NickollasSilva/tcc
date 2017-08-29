<div class="container">
<h2>Login</h2>
<br>

<?php echo validation_errors(); ?>

<?php echo $error; ?>

<?php echo form_open_multipart('games/login'); ?>

	<div class="form-group">
    	<label for="login">Login</label>
    	<input type="input" class="form-control" name="login" required/>
    </div>
    
    <div class="form-group">
    	<label for="password">Password</label>
    	<input type="password" class="form-control" name="password" required/>
    </div>

	<input type="hidden" class="form-control" value="<?php echo $lasturl;?>" name="lasturl"/>

	    <input type="submit" name="submit" value="Login" />
</form>
</div>
<br>
<a href="<?php echo site_url('games/' . $game['cd_Platform'] . '/' . $game['cd_Game']); ?>">Go to gamepage</a>

<div class="container">
<?php echo validation_errors(); ?>

<?php echo $error; ?>



<?php echo form_open_multipart('games/' . $game['cd_Platform'] . '/'. $game['cd_Game'] . '/insertsf'); ?>

	<input type="hidden" name="game" value="<?php echo $game['cd_Game']; ?>">	
	<h2>Insert a soundfile into "<?php echo $game['ds_Name']; ?>"</h2>
    
    <div class="form-group">
    	<label for="name">Name</label>
    	<input type="input" class="form-control name" name="name" required/>
    </div>	
    
	<div class="form-group">
		<label for="soundfile">Soundfile</label>
		<input type="file" name="soundfile" size="20" required/>
	</div>
    
    <input type="submit" name="submit" value="Insert" />

</form>
</div>

<div class="container">
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>File</th>
			<th>Button</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($soundfiles as $soundfiles_item): ?>
		<?php echo form_open_multipart('games/' . $game['cd_Platform'] . '/'. $game['cd_Game'] . '/editsf'); ?>
			<tr>
				<th><input class="name" type="input" name="name" value="<?php echo $soundfiles_item['ds_Name']; ?>" required></th>
				<th>
					<div class="form-group">
						<label for="soundfile">Soundfile</label>
						<input type="file" name="soundfile" size="20"/>
					</div>
					<input type="hidden" value="<?php echo $soundfiles_item['cd_Game']; ?>" name="game">
					<input type="hidden" value="<?php echo $soundfiles_item['cd_Filename']; ?>" name="filename">
					<input type="hidden" value="<?php echo $soundfiles_item['ds_Extension']; ?>" name="oldfileext">
				</th>
				<th><input type="submit" name="submit" value="Insert" /></th>
			</tr>		
		</form>
		<?php endforeach?>
	</tbody>

</table>
</div>
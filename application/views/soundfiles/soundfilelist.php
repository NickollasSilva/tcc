<div class="container">
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Size</th>
			<th>File Type</th>
			<th>Link</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($soundfiles as $soundfiles_item): ?>
			<tr>
				<th><?php echo $soundfiles_item['ds_Name']; ?></th>
				<th><?php echo $soundfiles_item['ds_Size']; ?>K</th>
				<th><?php echo $soundfiles_item['ds_Extension']; ?></th>
				<th>
					<a href="<?php echo base_url(); ?>files/soundfiles/
					<?php echo $soundfiles_item['cd_Filename'] . $soundfiles_item['ds_Extension']; ?>" download>
					Download
					</a>
				</th>
			</tr>		
		<?php endforeach?>
	</tbody>

</table>
</div>
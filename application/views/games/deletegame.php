
<?php echo form_open_multipart('games/' . $game['cd_Platform'] . '/'. $game['cd_Game'] . '/delete'); ?>
    <h1 style="text-align:center;"> Are you sure you want to delete this?</h1>
    <input type="hidden" value="yes" name="valid"/>
    <h1 style="text-align:center; margin:auto;"><input type="submit" value="Yes"/></h1>
</form>
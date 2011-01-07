<?php
    include 'header.php';
?>
<form action="actions.php">
    Description: <textarea name="description" rows=4 cols=60><?php echo $_SESSION["user"]->description;?></textarea><br>
    Photo: <input type="text" value="<?php echo $_SESSION["user"]->photourl ?>" name="photo-url">
<input type="hidden" name="action" value="update_profile"><br>
<input type="submit" value="Update">
</form>


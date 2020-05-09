<?php
if (isset($_FILES["image"]))
{
	$path = "upload/".rand(00000,99999).basename($_FILES['image']['name']);
	if(move_uploaded_file($_FILES['image']['tmp_name'],$path))
	{
		echo "file uploaded to: <a href=\"$path\">$path</a>";
	}
	else
	{
		echo "error uploading";
	}
}
else
{
?>

<html><body bgcolor="pink"><h1>PiC ShACK<h1></body></html>
<form method="POST" enctype="multipart/form-data">
Image: <input type="file" name="image">
<input type="submit" value="Upload!">

</form>
<p />
we host your images so you can share them with your friends and family!!
<?php

}
?>

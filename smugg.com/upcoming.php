<?php
    include 'header.php';
?>
<script type="text/javascript">
function smigg(box,story)
{
    $.post("smigg.php",{ story: story},function(data){
if(data!="") box.innerHTML=data; else if(confirm("You must be logged in first.")) window.location = "login.php";});
}
</script>
<h2>New Stories</h2>
<?php
    $result = pg_query("SELECT * FROM Upcoming");
    while($story = pg_fetch_array($result))
    {
    ?>
    <div class="story">
        <span class="smiggs" onclick=smigg(this,<?php echo $story["id"]; ?>)>
        <?php echo $story["smiggs"]; ?></span>
        <a href="#"><?php echo $story["title"]  ?></a>
        <p>
        <div class="description">
            <?php echo htmlspecialchars($story["description"]);  ?>
        </div>
        </p>
    </div>

<?php
    }

?>

<form action="changePrice.php" method=POST>
    <select name="item">
        <?php
            pg_connect("dbname=buyjunk");
            $result = pg_query("SELECT * FROM forsale");
            while($row = pg_fetch_array($result))
            {
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
        ?>
    </select>
    <br>
    price: $<input type="text" name="price">
    <br>
    <input type="submit">
</form>

<?php
$sql_dishes = "SELECT id, name from Dishes";
$sql_dishes = mysqli_query($link, $sql_dishes);
if (mysqli_num_rows($sql_dishes) > 0) {
    while ($row = mysqli_fetch_array($sql_dishes)) {
        $option_value = $row['id'];
        $option_name = $row['name'];
        $selected = ($option_name == $res_arr['name']) ? 'selected' : '';
        echo "<option value='" . $option_value . "' " . $selected . ">" . $option_name . "</option>";
    }
}
?>
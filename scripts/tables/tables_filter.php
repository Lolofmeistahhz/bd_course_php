<?php
$sql_halls = "SELECT id,name from Halls";
$result_halls = mysqli_query($link, $sql_halls);
if (mysqli_num_rows($result_halls) > 0) {
    while ($row = mysqli_fetch_array($result_halls)) {
        $option_value = $row['id'];
        $option_name = $row['name'];
        $selected = ($option_name == $res_arr['name']) ? 'selected' : '';
        echo "<option value='" . $option_value . "' " . $selected . ">" . $option_name . "</option>";
    }
}
?>
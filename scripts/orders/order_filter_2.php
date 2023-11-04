<?php
$sql_tables = "SELECT id, number from Tables";
$result_tables = mysqli_query($link, $sql_tables);
if (mysqli_num_rows($result_tables) > 0) {
    while ($row = mysqli_fetch_array($result_tables)) {
        $option_value = $row['id'];
        $option_name = $row['number'];
        $selected = ($option_name == $res_arr['number']) ? 'selected' : '';
        echo "<option value='" . $option_value . "' " . $selected . ">" . $option_name . "</option>";
    }
}
?>
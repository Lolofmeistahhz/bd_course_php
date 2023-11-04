<?php
$sql_positions = "SELECT id, name from Positions";
$result_positions = mysqli_query($link, $sql_positions);
if (mysqli_num_rows($result_positions) > 0) {
    while ($row = mysqli_fetch_array($result_positions)) {
        $option_value = $row['id'];
        $option_name = $row['name'];
        $selected = ($option_name == $res_arr['name']) ? 'selected' : '';
        echo "<option value='" . $option_value . "' " . $selected . ">" . $option_name . "</option>";
    }
}
?>
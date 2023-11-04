<?php
$sql_employee = "SELECT id, fullname from Employee";
$result_employee = mysqli_query($link, $sql_employee);
if (mysqli_num_rows($result_employee) > 0) {
    while ($row = mysqli_fetch_array($result_employee)) {
        $option_value = $row['id'];
        $option_name = $row['fullname'];
        $selected = ($option_name == $res_arr['fullname']) ? 'selected' : '';
        echo "<option value='" . $option_value . "' " . $selected . ">" . $option_name . "</option>";
    }
}
?>
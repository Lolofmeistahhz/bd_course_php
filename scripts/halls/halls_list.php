<?php
$sql_halls = "SELECT * FROM Halls";
$result_halls = mysqli_query($link, $sql_halls);

if ($result_halls) {
    if (mysqli_num_rows($result_halls) > 0) {
        $index = 0; // Уникальный индекс
        while ($row = mysqli_fetch_array($result_halls)) {
            $index++;
            echo '<div class="accordion mt-5" id="roomAccordion' . $index . '">' .
                '<div class="accordion-item">' .
                '<h2 class="accordion-header" id="roomHeading' . $index . '">' .
                '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#roomCollapse' . $index . '"
                    aria-expanded="false" aria-controls="roomCollapse' . $index . '">' .
                $row['name'] . 
                '</button>' .
                '</h2>' .
                '<div id="roomCollapse' . $index . '" class="accordion-collapse collapse" aria-labelledby="roomHeading' . $index . '"
                    data-bs-parent="#roomAccordion' . $index . '">' .
                    '<div class="accordion-body">' .
                    $row['description'] .
                    '</div>' .
                '</div>' .
                '</div>' .
                '</div>';
        }
    } else {
        echo "Нет данных для отображения.";
    }
} else {
    echo "Произошла ошибка: " . mysqli_error($link);
}
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

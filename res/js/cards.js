{/* <script>
    $(document).ready(function () {
        const cardContainer = $("#cardContainer");

    let authorCounter = 2;

    function addAuthorField() {
            const authorField = `
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="authorName${authorCounter}">Ф.И.О. автора</label><br>
                            <input type="text" name="authorName${authorCounter}" class="form-control">
                        </div>
                    </div>
                </div>
            ]`;
        cardContainer.append(authorField);
        authorCounter++;
        }

        $("#addButton").click(function () {
            const currentCardCount = cardContainer.find('.card').length;
        if (currentCardCount < 10) {
            addAuthorField();
            } else {
            alert('Вы достигли максимального количества карточек 10.');
            }
        });
    });
</script>

<a id="addButton" class="col-md-12 btn btn-light">Добавить автора</a> */}
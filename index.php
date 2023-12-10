<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="res/styles/styles.css">
    <title>Главная страница</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <div class="col-md-9">
            <a class="navbar-brand" href="auth.php">Ресторан</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-md-3">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Меню</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#halls">Залы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">Контакты</a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<body>
    <?php include 'connect.php' ?>
    <div id="carouselExampleControls" class="carousel slide" style="max-height:600px;" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="res/images/slide1.jpg" style="max-height:600px;" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="res/images/slide2.jpg" style="max-height:600px;" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="res/images/slide3.jpg" style="max-height:600px;" alt="Third slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5">
        <h1 class="text-center" id="menu"> Меню </h1>
        <hr>
        <?php include 'scripts/dishes/dish_list.php' ?>
        <hr>
    </div>
    <div class="container mt-5">
        <h1 class="text-center" id="halls">Залы</h1>
        <hr>
        <?php include 'scripts/halls/halls_list.php' ?>
        <hr class="mt-5">

    </div>
    <div class="container mt-5">
        <h1 class="text-center" id="contacts">Контакты</h1>
        <hr>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2387.239555165786!2d34.33794628248193!3d53.24940672067671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x412d58449af66885%3A0x85dac4f08dfbe520!2z0JHRgNGP0L3RgdC60LjQuSDQs9C-0YHRg9C00LDRgNGB0YLQstC10L3QvdGL0Lkg0LjQvdC20LXQvdC10YDQvdC-LdGC0LXRhdC90L7Qu9C-0LPQuNGH0LXRgdC60LjQuSDRg9C90LjQstC10YDRgdC40YLQtdGC!5e0!3m2!1sru!2sru!4v1699720375834!5m2!1sru!2sru"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="row mt-3">
            <div class="col-md-6 fs-4"><span class="material-symbols-outlined" style="font-size:18px;">
                    call
                </span>Номер телефона : +7-991-214-00-55</div>
            <div class="col-md-6 fs-4">
                <span class="material-symbols-outlined" style="font-size:18px;">
                    location_on
                </span>Адрес : г. Брянск, про-кт Станке Димитрова, 3
            </div>
        </div>
        <hr class="mt-3">
    </div>
</body>
<footer class="bg-light" style="padding:10px;">
    <div class="container">
        <p class="text-center mt-3">&copy; 2023 - Все права защищены</p>
    </div>
</footer>

</html>
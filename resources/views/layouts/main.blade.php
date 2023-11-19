<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товары</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">

    <style>
        body {
            color: var(--tg-theme-text-color);
            background: var(--tg-theme-bg-color);
        }

        .button-cart {
            position: fixed;
            bottom: 0;
            padding: 15px;
            margin-left: -1.5vh;
            border: none;
            width: 100%;
            color: var(--tg-theme-button-text-color);
            background: var(--tg-theme-button-color);
        }

        #map {
            width: 50%; height: 50%;
        }
        #viewContainer {
            margin: 8px;
        }

        .button-cart:hover {
            background: var(--tg-theme-secondary-bg-color);
        }

        @media (min-width: 768px) {

            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .bd-mode-toggle .dropdown-menu .active .bi {
                display: block !important;
            }
        }
    </style>

</head>
<body>
<header>
    <div class="collapse text-bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4>О нас</h4>
                    <p>Добавьте информацию ниже, об авторе или любом другом фоновом
                        контексте. Составьте несколько предложений, чтобы люди могли почерпнуть полезные сведения. Затем
                        свяжите их с сайтами социальных сетей или с контактной информацией.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4>Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Подписать на Twitter</a></li>
                        <li><a href="#" class="text-white">Лайк на Facebook</a></li>
                        <li><a href="#" class="text-white">Напишите мне</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('main.index') }}" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2"
                     viewBox="0 0 24 24">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                    <circle cx="12" cy="13" r="4"/>
                </svg>
                <strong>Заказы</strong>
            </a>
            <button class="navbar-toggler">
                <a href="/cart"><i class="fas fa-shopping-cart"></i></a>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Переключить навигацию">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

@yield('content')

</body>
<script src="https://telegram.org/js/telegram-web-app.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=77f63228-d2a0-4dc7-80e8-845fd5b6b6af" type="text/javascript"></script>
</html>

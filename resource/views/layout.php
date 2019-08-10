<html>
    <head>
        <title>Documentation</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=8851955c-63ba-46ae-9046-0c9c0c267219&lang=ru_RU" type="text/javascript">
        </script>
        <script>
            jQuery(function () {
                console.log("OK");
                ymaps.ready(init);
            });

            function init () {
                myMap = new ymaps.Map("map", {
                    center: [55.7548, 37.6208], // Углич
                    zoom: 11
                }, {
                    balloonMaxWidth: 200,
                    searchControlProvider: 'yandex#search'
                });

                // Обработка события, возникающего при щелчке
                // левой кнопкой мыши в любой точке карты.
                // При возникновении такого события откроем балун.
                myMap.events.add('click', function (e) {
                    if (!myMap.balloon.isOpen()) {
                        var coords = e.get('coords');
                        myMap.balloon.open(coords, {
                            contentHeader:'Событие!',
                            contentBody:'<p>Кто-то щелкнул по карте.</p>' +
                                '<p>Координаты щелчка: ' + [
                                    coords[0].toPrecision(6),
                                    coords[1].toPrecision(6)
                                ].join(', ') + '</p>',
                            contentFooter:'<sup>Щелкните еще раз</sup>'
                        });
                    }
                    else {
                        myMap.balloon.close();
                    }
                });

                // Обработка события, возникающего при щелчке
                // правой кнопки мыши в любой точке карты.
                // При возникновении такого события покажем всплывающую подсказку
                // в точке щелчка.
                myMap.events.add('contextmenu', function (e) {
                    myMap.hint.open(e.get('coords'), 'Кто-то щелкнул правой кнопкой');
                });

                // Скрываем хинт при открытии балуна.
                myMap.events.add('balloonopen', function (e) {
                    myMap.hint.close();
                });
            }
        </script>
    </head>
    <body>

    <div class="container">
        <?= $content ?>
        <div id="map" style="width: 600px; height: 400px"></div>
    </div>

    </body>
</html>

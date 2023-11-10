<template>
    <div>
        <div class="shopping-cart">
            <div id="map" style="width: 100%; height: 400px"></div>
            <div id="viewContainer"></div>

            <div class="tt"><p>Расстояние: 13 км</p></div>
            <div class="tt"><p>Стоимость доставки: 250 руб.</p></div>
            <div>
                <button id="order-tg" class="button-cart">Установить адрес</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Address",

    data() {
        return {
            address: [],
            outputElement: []
        }
    },

    mounted() {
        $(document).trigger('change')

        ymaps.ready(init);

        function init() {
            // Стоимость за километр.
            var DELIVERY_TARIFF = 20,
                // Минимальная стоимость.
                MINIMUM_COST = 150,
                myMap = new ymaps.Map('map', {
                    center: [44.21, 43.12],
                    zoom: 11,
                    controls: []
                }),
                // Создадим панель маршрутизации.
                routePanelControl = new ymaps.control.RoutePanel({
                    options: {
                        // Добавим заголовок панели.
                        float: 'left',
                        maxWidth: '300px',
                        minWidth: '200px',
                        showHeader: true,
                        title: 'Ваш адрес'
                    }
                }),
                zoomControl = new ymaps.control.ZoomControl({
                    options: {
                        size: 'large',
                        float: 'right',
                        position: {
                            top: 15,
                            right: 20
                        }
                    }
                });
            // Пользователь сможет построить только автомобильный маршрут.
            routePanelControl.routePanel.options.set({
                types: {auto: true}
            });

            // Если вы хотите задать неизменяемую точку "откуда", раскомментируйте код ниже.
            routePanelControl.routePanel.state.set({
                fromEnabled: false,
                from: 'Аэропорт Минеральные Воды имени М. Ю. Лермонтова'
            });

            myMap.controls.add(routePanelControl).add(zoomControl);

            // Получим ссылку на маршрут.
            routePanelControl.routePanel.getRouteAsync().then(function (route) {

                // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
                route.model.setParams({results: 1}, true);

                // Повесим обработчик на событие построения маршрута.
                route.model.events.add('requestsuccess', function () {

                    var activeRoute = route.getActiveRoute();
                    if (activeRoute) {
                        // Получим протяженность маршрута.
                        var length = route.getActiveRoute().properties.get("distance"),
                            // Вычислим стоимость доставки.
                            price = calculate(Math.round(length.value / 1000)),
                            // Создадим макет содержимого балуна маршрута.
                            balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                '<span>Расстояние: ' + length.text + '.</span><br/>' +
                                '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');

                        // Зададим этот макет для содержимого балуна.
                        route.options.set('routeBalloonContentLayout', balloonContentLayout);
                        $('#viewContainer').html("");
                        this.outputElement = $('<div><div class="tt"><p>Расстояние: ' + length.text + '"</p><div class="tt"><p>Стоимость доставки:  ' + price + ' руб."</p></div>').appendTo('#viewContainer');
                        this.rebuildOutput();
                        // Откроем балун.
                        activeRoute.balloon.open();
                    }
                });

            });

            // Функция, вычисляющая стоимость доставки.
            function calculate(routeLength) {
                if (routeLength <= 3) {
                    return Math.max(routeLength * DELIVERY_TARIFF, MINIMUM_COST);
                } else {
                    return Math.max((routeLength - 3) * DELIVERY_TARIFF + MINIMUM_COST, MINIMUM_COST);
                }
            }
        }
    },

    methods: {}
}
</script>

<style scoped>
#map {
    width: 50%;
    height: 50%;
}

#viewContainer {
    margin: 8px;
}
</style>

<template>
    <div>
        <div id="map" style="width: 100%; height: 400px"></div>
        <div v-if="address" class="shopping-cart" id="viewContainer">
            <div class="tt"><p>Расстояние: {{ address[0].lengths }}</p></div>
            <div class="tt"><p>Адрес: {{ address[0].address }}</p></div>
            <div class="tt"><p>Стоимость доставки: {{ address[0].price }} руб.</p></div>
        </div>
        <div v-else class="shopping-cart" id="viewContainer"></div>
        <div>
            <router-link :to="{ name: 'cart.index' }">
                <button class="button-cart">Перейти в корзину</button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Address",

    data() {
        return {
            address: null
        }
    },

    mounted() {
        $(document).trigger('change')

        this.getCartProducts();
        ymaps.ready(init);

        function init() {
            // Стоимость за километр.
            var DELIVERY_TARIFF = 20,
                // Минимальная стоимость.
                MINIMUM_COST = 150,
                myMap = new ymaps.Map('map', {
                    center: [44.2167, 43.1333],
                    zoom: 13,
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
                        size: 'small',
                        float: 'none',
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
                from: 'Речная улица, 6, Минеральные Воды'
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
                        var tochka = route.getWayPoints().get(1).properties.get('address')
                        var length = route.getActiveRoute().properties.get("distance"),
                            // Вычислим стоимость доставки.
                            price = calculate(Math.round(length.value / 1000)),
                            // Создадим макет содержимого балуна маршрута.
                            balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                '<span>Расстояние: ' + length.text + '.</span><br/>' +
                                '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');

                        // Зададим этот макет для содержимого балуна.
                        route.options.set('routeBalloonContentLayout', balloonContentLayout);
                        addToCart(length.text, price, tochka);
                        $('#viewContainer').html("");
                        $('<div><div class="tt"><p>Расстояние: ' + length.text + '</p></div><div class="tt"><p>Адрес: ' + tochka + '.</p></div><div class="tt"><p>Стоимость доставки:  ' + price + ' руб.</p></div></div>').appendTo('#viewContainer');
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

            function addToCart(dlina, price, tochka) {
                let address = localStorage.getItem('address')
                let newAddress = [
                    {
                        'lengths': dlina,
                        'address': tochka,
                        'price': price,
                    }
                ]

                localStorage.setItem('address', JSON.stringify(newAddress));
            }
        }
    },

    methods: {

        getCartProducts() {
            this.address = JSON.parse(localStorage.getItem('address'))
        }
    }
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

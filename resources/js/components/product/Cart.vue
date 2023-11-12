<template>
    <div>
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title">
                Корзина
            </div>

            <!-- Товар #1 -->
            <div v-for="product in products" class="item row">
                <div class="product-image col-auto">
                    <router-link :to="{name: 'products.show', params: { id: product.id }}">
                        <img :src="product.image_url" class="pic-1">
                    </router-link>
                </div>

                <div class="description col-4">
                    <router-link :to="{name: 'products.show', params: { id: product.id }}">
                        <span>{{ product.title }}</span>
                    </router-link>
                </div>
                <div class="col-4">
                    <div class="qtySelector">
                        <span @click.prevent="minusQty(product)" class="minus">-</span>
                        <span class="qtyValue">{{ product.qty }}</span>
                        <span @click.prevent="plusQty(product)" class="plus">+</span>
                    </div>

                    <div class="total-price">{{ product.price }} руб. * {{ product.qty }} =
                        {{ product.price * product.qty }} руб.
                    </div>
                </div>
                <div @click.prevent="removeProduct(product.id)" class="remove col-auto">
                    <p class="danger">x</p>
                </div>
            </div>
            <div v-if="address">
                <div class="amount-total">
                    Доставка: {{ address[0].price }} руб.<br/>
                    Итого: {{ sum }} руб., Кол-во: {{ counts }} шт.
                </div>
                <div>
                    <button id="order-tg" class="button-cart">Оформить заказ</button>
                </div>
            </div>
            <div v-else class="amount-total">
                Не выбрана доставка<br/>
                <router-link :to="{ name: 'address.index' }" class="m-2">Доставка</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cart",

    mounted() {
        $(document).trigger('change')
        this.getCartProducts()
        this.getCartAddress()

        let tg = window.Telegram.WebApp;
        let order = document.getElementById("order-tg");
        tg.expand();

        let produ = localStorage.getItem('cart');
        produ = JSON.parse(produ);
        produ.forEach(product => {
                product.image_url = null
        });

        let zakaztg = [];
        zakaztg.push(produ);
        zakaztg.push(this.address);

        if (order) {
            order.addEventListener("click", () => {
                tg.sendData(zakaztg);
                tg.close();
            });
        }
    },

    data() {
        return {
            products: [],
        }
    },

    computed: {
        sum() {
            let result = 0;
            this.products.forEach(product => result += product.price * product.qty);
            return (result + this.address[0].price);
        },
        counts() {
            let result = 0;
            this.products.forEach(product => result += product.qty);
            return result;
        }
    },

    methods: {

        addToCart(product) {
            let cart = localStorage.getItem('cart')
            let newProduct = [
                {
                    'id': product.id,
                    'image_url': product.image_url,
                    'title': product.title,
                    'price': product.price,
                    'qty': 1
                }
            ]
            if (!cart) {
                localStorage.setItem('cart', JSON.stringify(newProduct));
            } else {
                cart = JSON.parse(cart)

                cart.forEach(productInCart => {
                    if (productInCart.id === product.id) {
                        productInCart.qty = Number(productInCart.qty) + 1
                        newProduct = null
                    }
                })

                Array.prototype.push.apply(cart, newProduct)

                localStorage.setItem('cart', JSON.stringify(cart))
            }
        },

        getCartAddress() {
            this.address = JSON.parse(localStorage.getItem('address'))
        },

        getCartProducts() {
            this.products = JSON.parse(localStorage.getItem('cart'))
            $(document).trigger('changed')
        },

        minusQty(product) {
            if (product.qty < 2) return this.removeProduct(product.id)
            product.qty--
            this.updateCart()
        },

        plusQty(product) {
            if (product.qty >= 10) return
            product.qty++
            this.updateCart()
        },

        removeProduct(id) {
            this.products = this.products.filter(product => {
                return product.id !== id
            })
            this.updateCart()
        },

        updateCart() {
            localStorage.setItem('cart', JSON.stringify(this.products))
        }
    }
}
</script>

<style scoped>
.shopping-cart {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.title {
    height: 60px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    font-size: 18px;
    font-weight: 400;
}

.danger {
    color: red;
    font-weight: bold;
}

.item {
    display: flex;
    height: 120px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    font-size: 18px;
    font-weight: 400;
}

.item:nth-child(3) {
    border-top: 1px solid #E1E8EE;
    border-bottom: 1px solid #E1E8EE;
}

.amount-total {
    height: 90px;
    border-bottom: 1px solid #E1E8EE;
    padding: 15px 30px;
    font-size: 18px;
    font-weight: 400;
    text-align: right;
}


.pic-1 {
    width: 100px;
    height: auto;
    transition: all 0.3s;
}

.product-image {
    width: 20%;
}


@keyframes animate {
    0% {
        background-position: left;
    }
    50% {
        background-position: right;
    }
    100% {
        background-position: right;
    }
}

.description span {
    display: block;
    font-size: 14px;
    font-weight: 400;
}

.description span:first-child {
    margin-bottom: 5px;
}

.description span:last-child {
    font-weight: 300;
    margin-top: 8px;
}

.qtySelector {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2vh;
    font-weight: bold;

}

.qtySelector span {
    width: 30%;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    user-select: none;
    border-radius: 1vh;
    color: var(--tg-theme-button-text-color);
    background: var(--tg-theme-button-color);
    box-shadow: 0 5vh 10vh rgba(0, 0, 0, 0.2);
}

.qtySelector span.qtyValue {
    font-size: 2vh;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    pointer-events: none;
}

.total-price {
    padding-top: 27px;
    text-align: center;
    font-size: 16px;;
    font-weight: 300;
}
</style>

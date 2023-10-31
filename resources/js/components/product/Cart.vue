<template>
<div>
    <div class="shopping-cart">
        <!-- Title -->
        <div class="title">
            Корзина
        </div>

        <!-- Товар #1 -->
        <div v-for="product in products" class="item">
            <div class="product-image">
                <img :src="product.image_url" class="pic-1">
            </div>

            <div class="description">
                <router-link :to="{name: 'products.show', params: { id: product.id }}">
                    <span>{{ product.title }}</span>
                </router-link>
            </div>

            <div class="qtySelector">
                <span class="minus">-</span>
                <input type="number" class="qtyValue" :value="product.qty"/>
                <span class="plus">+</span>
            </div>

            <div class="total-price">${{ product.price}} * {{ product.qty }} = {{ product.price * product.qty }}</div>
        </div>

        <div class="amount-total">
            Итого: ххх рубль
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
    },

    data() {
        return {
            products: []
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

                cart.forEach(productInCart =>{
                    if (productInCart.id === product.id) {
                        productInCart.qty = Number(productInCart.qty) + 1
                        newProduct = null
                    }
                })

                Array.prototype.push.apply(cart, newProduct)

                localStorage.setItem('cart', JSON.stringify(cart))
            }
        },
        getCartProducts() {
            this.products = JSON.parse(localStorage.getItem('cart'))
            $(document).trigger('changed')
        },
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
    color: #5E6977;
    font-size: 18px;
    font-weight: 400;
}

.item {
    display: flex;
    height: 120px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    color: #5E6977;
    font-size: 18px;
    font-weight: 400;
    background: #FFFFFF;
}

.item:nth-child(3) {
    border-top:  1px solid #E1E8EE;
    border-bottom:  1px solid #E1E8EE;
}

.amount-total {
    height: 60px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    color: #5E6977;
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
    0%   { background-position: left;  }
    50%  { background-position: right; }
    100% { background-position: right; }
}

.description {
    width: 40%;
}

.description span {
    display: block;
    font-size: 14px;
    color: #43484D;
    font-weight: 400;
}

.description span:first-child {
    margin-bottom: 5px;
}
.description span:last-child {
    font-weight: 300;
    margin-top: 8px;
    color: #86939E;
}

.wrapper{
    height: 50px;
    width: 20%;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 12px;
}

.wrapper span {
    width: 100%;
    text-align: center;
    font-size: 25px;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.wrapper span.num{
    font-size: 20px;
    pointer-events: none;
}

button[class*=btn] {
    width: 30%;
    height: 30px;
    background-color: #E1E8EE;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

button:focus,
input:focus {
    outline:0;
}
.total-price {
    width: 20%;
    padding-top: 27px;
    text-align: center;
    font-size: 16px;
    color: #43484D;
    font-weight: 300;
}
</style>

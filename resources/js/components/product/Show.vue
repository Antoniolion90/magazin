<template>
    <div>
        <div v-if="product" class="shopping-cart">
            <!-- Title -->
            <div class="title">
                {{ product.title }}
            </div>
            <div class="product-image">
                <img :src="product.image_url" class="pic-1">
            </div>
            <div class="description">
                <span>{{ product.description }}</span>
            </div>
            <div class="qtySelector">
                <span class="minus">-</span>
                <input type="number" class="qtyValue" value="1"/>
                <span class="plus">+</span>
            </div>
            <div class="product">
                <a class="add-to-cart" @click.prevent="addToCart(product)" href="#">
                    <i class="fas fa-shopping-cart"></i><span>в корзину</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",

    data() {
        return {
            product: null
        }
    },

    props: {
        id: {
            type: Number,
            required: true
        }
    },

    mounted() {
        this.getProduct();
        $(document).trigger('change')
    },

    methods: {
        addToCart(product) {
            let cart = localStorage.getItem('cart')

            let qty = $('input.qtyValue').val() ? $('input.qtyValue').val() : 1
            $('input.qtyValue').val(1)
            let newProduct = [
                {
                    'id': product.id,
                    'image_url': product.image_url,
                    'title': product.title,
                    'price': product.price,
                    'qty': qty
                }
            ]
            if (!cart) {
                localStorage.setItem('cart', JSON.stringify(newProduct));
            } else {
                cart = JSON.parse(cart)

                cart.forEach(productInCart =>{
                    if (productInCart.id === product.id) {
                        productInCart.qty = Number(productInCart.qty) + Number(qty)
                        newProduct = null
                    }
                })

                Array.prototype.push.apply(cart, newProduct)

                localStorage.setItem('cart', JSON.stringify(cart))
            }
        },
        getProduct() {
            this.axios.get(`/api/products/${this.id}`)
                .then(res => {
                    this.product = res.data.data;
                })
                .catch(error => console.log(error.message));
        }
    }
}
</script>

<style scoped>
.title {
    height: 60px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    color: #5E6977;
    font-size: 18px;
    font-weight: 400;
}

.wrapper span {
    width: 30%;
    text-align: center;
    font-size: 25px;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.product-content {
    width: 100%;
    padding: 12px 0;
    display: inline-block;
}

.add-to-cart {
    color: #000;
    background: #fff;
    font-size: 13px;
    font-weight: 600;
    text-align: left;
    width: 75%;
    margin: 0 auto;
    border: 1px solid #033772;
    display: block;
    transition: all .3s ease;
}

.add-to-cart:hover {
    color: #fff;
    background: #033772;
}

.add-to-cart i {
    color: #fff;
    background-color: #033772;
    text-align: center;
    line-height: 35px;
    height: 35px;
    width: 35px;
    border-right: 1px solid #fff;
    display: inline-block;
}

.add-to-cart span {
    text-align: center;
    line-height: 35px;
    height: 35px;
    width: calc(100% - 40px);
    padding: 0 6px;
    vertical-align: top;
    display: inline-block;
}

.pic-1 {
    width: 30px;
    height: auto;
    transition: all 0.3s;
}

.wrapper span.num{
    font-size: 20px;
    pointer-events: none;
}

.description {
    width: 50%;
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
.cart-button {
    position: relative;
    padding: 10px;
    width: 200px;
    height: 50px;
    border: 0;
    border-radius: 10px;
    background-color: #2b3044;
    outline: none;
    cursor: pointer;
    margin: 0 10px;
    color: #fff;
    transition: 0.3s ease-in-out;
    overflow: hidden;
    user-select: none;
}

.cart-button:hover {
    background-color: #202431;
}
.cart-button:active {
    transform: scale(0.9);
}

.cart-button .fa-shopping-cart {
    position: absolute;
    z-index: 2;
    top: 50%;
    left: -10%;
    font-size: 2em;
    transform: translate(-50%, -50%);
}

.cart-button span {
    position: absolute;
    z-index: 3;
    left: 50%;
    top: 50%;
    font-size: 1.2em;
    color: #fff;
    transform: translate(-50%, -50%);
}
.cart-button span.add-to-cart {
    opacity: 1;
}
.cart-button span.added {
    opacity: 0;
}

.cart-button.clicked .fa-shopping-cart {
    animation: cart 1.5s ease-in-out forwards;
}

.cart-button.clicked span.add-to-cart {
    animation: txt1 1.5s ease-in-out forwards;
}
.cart-button.clicked span.added {
    animation: txt2 1.5s ease-in-out forwards;
}
@keyframes cart {
    0% {
        left: -10%;
    }
    40%,
    60% {
        left: 50%;
    }
    100% {
        left: 110%;
    }
}

@keyframes txt1 {
    0% {
        opacity: 1;
    }
    20%,
    100% {
        opacity: 0;
    }
}
@keyframes txt2 {
    0%,
    80% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.pqt-plus,
.pqt-minus {
    background: #fff;
    border: none;
    font-size: 20px;
    padding: 0 20px;
    width: 50px;
    border-radius: 10px;
    height: 50px;
    user-select: none;
    line-height: 50px;
}

.pqt-plus:hover,
.pqt-minus:hover {
    background: #202431;
    color: #fff;
    cursor: pointer;
}
</style>

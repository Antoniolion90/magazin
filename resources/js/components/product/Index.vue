<template>
    <div>
        <div class="row row-cols-md-2">
            <div v-for="product in products">
                <div class="product-grid">
                    <div class="product-image">
                        <router-link :to="{ name: 'products.show', params: { id: product.id }}" class="image">
                            <img :src="product.image_url" class="pic-1">
                        </router-link>
                        <span class="product-new-label">new</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title">{{ product.title }}</h3>
                        <div class="row row-cols-md-2">
                            <div class="price">{{ product.price }} руб.</div>

                            <div>
                                <div v-if="!(noCarts(product.id))" class="product">
                                    <a class="add-to-cart" @click.prevent="addToCart(product)" href="#">
                                        <i class="fas fa-shopping-cart"></i><span>Купить</span>
                                    </a>
                                </div>
                                <div v-else class="product">
                                    <div v-for="cart in cartFilter(product.id)" :key="product.id" class="qtyCart">
                                        <span @click.prevent="minusQty(cart)" class="minus">-</span>
                                        <span class="num">{{ cart.qty }}</span>
                                        <span @click.prevent="plusQty(cart)" class="plus">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="carts">
                <div v-if="carts.length">
                    <router-link :to="{ name: 'cart.index' }">
                        <button class="button-cart">Перейти в корзину</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",

    mounted() {
        this.getProducts();
        this.getCartProducts();
        let tg = window.Telegram.WebApp;
        tg.expand();
    },

    data() {
        return {
            products: [],
            carts: [],
            cart: []
        }
    },

    methods: {

        getProducts() {
            this.axios.get('/api')
                .then(res => {
                    this.products = res.data.data;
                })
                .catch(error => console.log(error.message));
        },
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
            this.getCartProducts();
        },
        getCartProducts() {
            this.carts = JSON.parse(localStorage.getItem('cart'))
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
            this.cart = []
            this.carts = this.carts.filter(product => {
                return product.id !== id
            })
            this.updateCart()
        },

        cartFilter(id) {
            if (Array.isArray(this.carts)) {
                return this.carts.filter(article => article.id === id)
            }
        },

        noCarts(id) {
            if (Array.isArray(this.carts)) {
                for (let article of this.carts) {
                    if (article.id === id) {
                        return true
                    }
                }
            }
        },

        updateCart() {
            localStorage.setItem('cart', JSON.stringify(this.carts))
        }
    }
}
</script>

<style scoped>
.product-grid {
    padding-top: 10px;
    font-family: 'Open Sans', sans-serif;
    text-align: center;
}

.product-grid .product-image {
    position: relative;
    overflow: hidden;
}

.product-grid .product-image a.image {
    display: block;
}

.product-grid .product-image img {
    width: 100%;
    height: auto;
    transition: all 0.3s;
}

.product-grid .product-image:hover img {
    transform: scale(1.05);
}

.product-grid .product-new-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 3px 10px 10px;
    position: absolute;
    background: red;
    top: 0px;
    left: 0;
    clip-path: polygon(0 0, 100% 0, 100% 75%, 15% 75%, 0 100%, 0% 25%);
}

.product-grid .product-content {
    width: 100%;
    padding: 12px 0;
    display: inline-block;
}

.product-grid .title {
    margin: 0 0 7px;
    font-size: 1.5rem;
    font-family: 'Nunito', sans-serif;
    text-transform: capitalize;
    font-weight: bold;
}

.product-grid .title a {
    transition: all 0.4s ease-out;
}

.product-grid .price {
    color: green;
    font-size: 1.5rem;
    font-weight: bold;
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

.qtyCart {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2vh;
    font-weight: bold;


}

.qtyCart span {
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

.qtyCart span.num {
    font-size: 2vh;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    pointer-events: none;
}

</style>

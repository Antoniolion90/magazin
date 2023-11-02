<template>
    <div>
        <div class="container">
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
                <div class="price">{{ product.price }} руб.</div>
                <div class="row row-cols-md-2">
                    <div v-if="cart[0]" class="qtyCart">
                        <span @click.prevent="minusQty(cart[0])" class="minus">-</span>
                        <span class="num">{{ cart[0].qty }}</span>
                        <span @click.prevent="plusQty(cart[0])" class="plus">+</span>
                    </div>
                    <div v-else class="product">
                        <a class="add-to-cart" @click.prevent="addToCart(product)" href="#">
                            <i class="fas fa-shopping-cart"></i><span>Купить</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Show",

    data() {
        return {
            product: null,
            carts: [],
            cart: []
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
        this.getCartProducts();
    },

    methods: {
        getProduct() {
            this.axios.get(`/api/products/${this.id}`)
                .then(res => {
                    this.product = res.data.data;
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
        },

        getCartProducts() {
            this.carts = JSON.parse(localStorage.getItem('cart'))
            this.cart = this.carts.filter( product => { return product.id == this.id })
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
            this.carts = this.carts.filter( product => {
                return product.id !== id
            })
            this.updateCart()
        },

        updateCart() {
            localStorage.setItem('cart', JSON.stringify(this.carts))
        }
    }
}
</script>

<style scoped>

.title {
    height: 60px;
    padding: 20px 30px;
    color: #000;
    font-size: 18px;
    font-weight: bold;
}

.price {
    color: green;
    font-size: 1.5rem;
    font-weight: bold;
    display: inline-block;
    padding: 0 30px 10px 20px;
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

.product-image {
    position: relative;
    overflow: hidden;
}

.product-image img {
    width: 80%;
    height: auto;
    transition: all 0.3s;
}

.description {
    height: 60px;
    padding: 20px 30px 10px 20px;
    color: #000;
    font-size: 18px;
}

.description span {
    display: block;
    font-size: 14px;
    color: #000;
    font-weight: bold;
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
    background: #fff;
    border-radius: 1vh;
    box-shadow: 0 5vh 10vh rgba(0, 0, 0, 0.2);
}

.qtyCart span.num {
    font-size: 2vh;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    pointer-events: none;
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

</style>

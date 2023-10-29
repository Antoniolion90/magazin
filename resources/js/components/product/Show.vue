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
            <div class="product-content">
                <a class="add-to-cart" @click.prevent="addToCart(product.id)" href="#">
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
    },

    methods: {
        addToCart(id) {
            let cart = localStorage.getItem('cart')

            let qty = $('input.qtyValue').val() ? $('input.qtyValue').val() : 1
            $('input.qtyValue').val(1)
            let newProduct = [
                {
                    'id': id,
                    'qty': qty
                }
            ]
            if (!cart) {
                localStorage.setItem('cart', JSON.stringify(newProduct));
            } else {
                cart = JSON.parse(cart)

                cart.forEach(productInCart =>{
                    if (productInCart.id === id) {
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
.wrapper{
    height: 50px;
    width: 25%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 12px;
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
    width: 50%;
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
</style>

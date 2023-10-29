<template>
<div>
    <div class="shopping-cart">
        <!-- Title -->
        <div class="title">
            Корзина
        </div>

        <!-- Товар #1 -->
        <div class="item">
            <div class="buttons">
                <span class="delete-btn">X</span>
            </div>

            <div class="description">
                <span>Common Projects</span>
                <span>Bball High</span>
                <span>White</span>
            </div>

            <div class="wrapper">
                <span class="minus">-</span>
                <span class="num">01</span>
                <span class="plus">+</span>
            </div>

            <div class="total-price">$549</div>
        </div>

        <!-- Товар #2 -->
        <div class="item">
            <div class="buttons">
                <span class="delete-btn">X</span>
            </div>

            <div class="description">
                <span>Maison Margiela</span>
                <span>Future Sneakers</span>
                <span>White</span>
            </div>

            <div class="wrapper">
                <span class="minus">-</span>
                <span class="num">01</span>
                <span class="plus">+</span>
            </div>

            <div class="total-price">$870</div>
        </div>

        <!-- Товар #3 -->
        <div class="item">
            <div class="buttons">
                <span class="delete-btn">X</span>
            </div>

            <div class="description">
                <span>Our Legacy</span>
                <span>Brushed Scarf</span>
                <span>Brown</span>
            </div>

            <div class="wrapper">
                <span class="minus">-</span>
                <span class="num">01</span>
                <span class="plus">+</span>
            </div>

            <div class="total-price">$349</div>
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
        const plus = document.querySelector(".plus"),
            minus = document.querySelector(".minus"),
            num = document.querySelector(".num");

        let a = 1;

        plus.addEventListener("click", () => {
            a++;
            a = (a < 10) ? "0" + a : a;
            num.innerText = a;
        });

        minus.addEventListener("click", () => {
            if (a > 1) {
                a--;
                a = (a < 10) ? "0" + a : a;
                num.innerText = a;
            }
        });
    }
}

</script>

<style scoped>
.shopping-cart {
    width: 100%;
    height: 423px;
    margin: 80px auto;
    background: #FFFFFF;
    box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
    border-radius: 6px;

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

.amount-total {
    height: 60px;
    border-bottom: 1px solid #E1E8EE;
    padding: 20px 30px;
    color: #5E6977;
    font-size: 18px;
    font-weight: 400;
    text-align: right;
}

.item {
    padding: 20px 30px;
    height: 120px;
    display: flex;
}

.item:nth-child(3) {
    border-top:  1px solid #E1E8EE;
    border-bottom:  1px solid #E1E8EE;
}
.buttons {
    position: relative;
    padding-top: 30px;
    width: 10%;
}
.delete-btn {
    display: inline-block;
    Cursor: pointer;
}
.delete-btn {
    width: 18px;
    height: 17px;
}

@keyframes animate {
    0%   { background-position: left;  }
    50%  { background-position: right; }
    100% { background-position: right; }
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

.wrapper{
    height: 50px;
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

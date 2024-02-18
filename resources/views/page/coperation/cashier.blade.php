<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('css/cashier.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="">

    <div class="container">
        <header>
            <h1>Your Shopping Cart</h1>
            <div class="shopping">
                <img src="image/shopping.svg">
                <span class="quantity">0</span>
            </div>
        </header>

        <div class="list">

        </div>
    </div>
    <form action="{{ route('cashier.submit') }}" method="POST" class="card">
        @csrf
        <h1>KASIR</h1>
        <ul class="listCard">
        </ul>
        <div class="checkOut">
            <input type="hidden" id="totalPrice" name="totalPrice">
            <button type="submit" class="total">0</button>
            <a href="/dashboard" class="closeShopping">Close</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session('success'))
    <script>
        Toastify({
            text: "Berhasil Checkout",
            className: "info",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
        </script>
    @endif
    <script>
        let openShopping = document.querySelector('.shopping');
        let closeShopping = document.querySelector('.closeShopping');
        let list = document.querySelector('.list');
        let listCard = document.querySelector('.listCard');
        let body = document.querySelector('body');
        let total = document.querySelector('.total');
        let quantity = document.querySelector('.quantity');
        let totalPriceTag = document.querySelector('#totalPrice');

        openShopping.addEventListener('click', () => {
            body.classList.add('active');
        })
        closeShopping.addEventListener('click', () => {
            body.classList.remove('active');
        })

        let products = [
        ];

        const fetchData = async() => {
            try {
                const response = await axios.get(`${window.location.origin}/items/get`);
                const items = response.data.data;
                products = [...items];
            } catch (err) {
                console.error(err)
            }
            initApp();
        }


        let listCards = [];

        fetchData();
        function initApp() {
            products.forEach((value, key) => {
                let newDiv = document.createElement('div');
                newDiv.classList.add('item');
                newDiv.innerHTML = `
            <img src="${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${parseInt(value.price).toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
                list.appendChild(newDiv);
            })
        }


        function addToCard(key) {
            if (listCards[key] == null) {
                // copy product form list to list card
                listCards[key] = JSON.parse(JSON.stringify(products[key]));
                listCards[key].quantity = 1;
            }
            reloadCard();
        }

        function reloadCard() {
            listCard.innerHTML = '';
            let count = 0;
            let totalPrice = 0;
            listCards.forEach((value, key) => {
                totalPrice = totalPrice + value.price;
                count = count + value.quantity;
                if (value != null) {
                    let newDiv = document.createElement('li');
                    if (key === listCards.length - 1) {
                        newDiv.classList.add('last');
                    }
                    newDiv.innerHTML = `
                <div><img src="{{ asset('img/65.png') }}"/></div>
                <div>${value.name}</div>
                <input type="hidden" value="${value.id}" name="itemId[]">
                <input type="hidden" value="${value.quantity}" name="quantity[]">
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                    listCard.appendChild(newDiv);
                }
            })
            total.innerText = totalPrice.toLocaleString();
            totalPriceTag.value = totalPrice;
            quantity.innerText = count;
        }

        function changeQuantity(key, quantity) {
            if (quantity == 0) {
                delete listCards[key];
            } else {
                listCards[key].quantity = quantity;
                listCards[key].price = quantity * products[key].price;
            }
            reloadCard();
        }
    </script>
</body>

</html>

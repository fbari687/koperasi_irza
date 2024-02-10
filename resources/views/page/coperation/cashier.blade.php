<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('css/cashier.css') }}">
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
            <button type="submit" class="total">0</button>
            <div class="closeShopping">Close</div>
        </div>
    </form>

    <script>
        let openShopping = document.querySelector('.shopping');
        let closeShopping = document.querySelector('.closeShopping');
        let list = document.querySelector('.list');
        let listCard = document.querySelector('.listCard');
        let body = document.querySelector('body');
        let total = document.querySelector('.total');
        let quantity = document.querySelector('.quantity');

        openShopping.addEventListener('click', () => {
            body.classList.add('active');
        })
        closeShopping.addEventListener('click', () => {
            body.classList.remove('active');
        })

        let products = [{
                id: 1,
                name: 'SEKOLAH MISKIN 1',
                image: '1.PNG',
                price: 120000
            },
            {
                id: 2,
                name: 'SEKOLAH MISKIN 2',
                image: '2.PNG',
                price: 120000
            },
            {
                id: 3,
                name: 'SEKOLAH MISKIN 3',
                image: '3.PNG',
                price: 220000
            },
            {
                id: 4,
                name: 'SEKOLAH MISKIN 4',
                image: '4.PNG',
                price: 123000
            },
            {
                id: 5,
                name: 'SEKOLAH MISKIN 5',
                image: '5.PNG',
                price: 320000
            },
            {
                id: 6,
                name: 'SEKOLAH MISKIN 6',
                image: '6.PNG',
                price: 120000
            },
            {
                id: 7,
                name: 'SEKOLAH MISKIN 7',
                image: '6.PNG',
                price: 120000
            },
            {
                id: 8,
                name: 'SEKOLAH MISKIN 8',
                image: '6.PNG',
                price: 120000
            },
            {
                id: 9,
                name: 'SEKOLAH MISKIN 9',
                image: '6.PNG',
                price: 120000
            },
            {
                id: 10,
                name: 'SEKOLAH MISKIN 10',
                image: '6.PNG',
                price: 120000
            },
        ];
        let listCards = [];

        function initApp() {
            products.forEach((value, key) => {
                let newDiv = document.createElement('div');
                newDiv.classList.add('item');
                newDiv.innerHTML = `
            <img src="{{ asset('img/65.png') }}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
                list.appendChild(newDiv);
            })
        }
        initApp();

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
                <input type="hidden" value="${value.id}" name="product[]">
                <input type="hidden" value="${value.quantity}" name="total[]">
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

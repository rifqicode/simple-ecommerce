async function getFilteredItem() {
    let cart = JSON.parse(localStorage.getItem('cart')) ?? [];
    let cartFilter = cart.filter((data) => {
        return data != null;
    });

    return cartFilter;
}

async function renderItem(category) {
    var url = BASE_URL + '/get-product/' + category;

    let target = $('body');

    target.loader();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            $('#item').html(res.html)
            target.trigger('destroy.loader');
        }
    });
}

function addItem(data) {
    let {id, name, price} = data;
    let cart = JSON.parse(localStorage.getItem('cart')) ?? [];

    // get current item
    let lastValue = cart[id] == undefined ? 1 : cart[id].amount + 1;
    let totalPrice = price * lastValue;
    // update last value

    data['amount'] = lastValue;
    data['totalprice'] = totalPrice;

    cart[id] = data

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCurrentItem();
    showAlert('success', 'Item added!')
}

async function removeItem(idItem) {
    let cart = JSON.parse(localStorage.getItem('cart')) ?? [];
    let keyItem = 0;
    let item = null;

    let map = cart.map((value, index) => {
        if (value && value.id == idItem) {
            keyItem = index;
            item = value;
        }
    });

    let removed = false;

    if (item.amount > 1) {
        cart[keyItem].amount -= 1;
        cart[keyItem].totalprice = cart[keyItem].totalprice - cart[keyItem].price;
        
    console.log(cart[keyItem]);
    } else {
        cart.splice(keyItem, 1);
        removed = true;
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    renderItemList();
    updateCurrentItem();

    showAlert('success', removed ? 'item deleted successfully' : 'item successfully reduced to ' + cart[idItem].amount);
}

async function updateCurrentItem() {
    let cart = await getFilteredItem()
    $('#current-item').html(cart.length);
}

async function renderItemList() {
    let cart = await getFilteredItem()
    let target = $('#shop-list-item');

    let result = '';
    let totalAllPrice = 0,
        totalAllAmount = 0;

    cart.map((value, key) => {
        let {id, name, price, amount, totalprice} = value;

        result += `<li id="${id}" class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold">
                ${name} | Rp. ${number_format(price)} <span class="badge bg-success rounded-pill ml-2">${amount}</span>
            </div>
                Rp. ${number_format(totalprice)}
            </div>
            <button class="badge bg-danger rounded-pill ml-2 remove-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
          </svg></button>
        </li>`

        totalAllPrice += value.price;
        totalAllAmount += value.amount;
    });

    let shopTotal = `Total : <span class="float-right"> Rp. ${number_format(totalAllPrice)} | ${totalAllAmount} Item </span>`;
    target.html(result);
    $('#shop-total').html(shopTotal);
}

function showAlert(type, message) {
    let template = `<div class="alert alert-${type} alert-flash" role="alert" style="position: absolute; right:20px; top: 100px">
        ${message}
    </div>`;

    $('#alert-message').html(template);

    $('.alert-flash').fadeIn().delay(2000).fadeOut();
}


async function order() {
    let getListItem = await getFilteredItem();
    let name = $('#name').val(),
        address = $('#address').val();

    let list = '';

    let message = `Order masuk dari *FoodMarket*

`;
    message += `Nama Pemesan : *${name}*
`;
    message += `Alamat Pemesan : *${address}*

`;

    getListItem.map((value, key) => {
        list += `- *${value.name} x ${value.amount} | ${number_format(value.price)}*
`;
    });

    message += `List Pesanan :
${list}`;

    message += `
*Terima Kasih sudah berbelanja lewat aplikasi FoodMarket*`;

    window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(message)}`, '_blank');
}

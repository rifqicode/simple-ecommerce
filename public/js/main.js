async function getDataItem() {
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

async function addItemToCart(data) {
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

async function updateCurrentItem() {
    let cart = await getDataItem()
    $('#current-item').html(cart.length);
}

async function renderItemList() {
    let cart = await getDataItem()
    let target = $('#shop-list-item');

    let result = '';

    cart.map((value, key) => {
        let {id, name, price, amount, totalprice} = value;

        result += `<li id="${id}" class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold">${name} | Rp. ${number_format(price)} </div>
                Rp. ${number_format(totalprice)}
            </div>
            <span class="badge bg-danger rounded-pill">${amount}</span>
        </li>`
    });


    target.html(result);
}

function showAlert(type, message) {
    let template = `<div class="alert alert-${type}" role="alert" style="position: absolute; right:20px; top: 100px">
        ${message}
    </div>`;

    $('#alert-message').html(template);

    $('.alert').fadeIn().delay(2000).fadeOut();
}

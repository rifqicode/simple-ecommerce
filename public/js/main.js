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
    let item = cart.filter((value, index) => {
        if (value && value.id != undefined) {
            keyItem = value.id == idItem ? index : 0;
            return value.id == idItem ?? false;
        }

        return false;
    });


    let removed = false;

    if (item[0].amount > 1) {
        cart[keyItem].amount -= 1;
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
                ${name} | Rp. ${number_format(price)}
            </div>
                Rp. ${number_format(totalprice)}
            </div>
            <span class="badge bg-success rounded-pill">${amount}</span>
            <span class="badge bg-danger rounded-pill ml-2 remove-item"> - </span>
        </li>`

        totalAllPrice += value.price;
        totalAllAmount += value.amount;
    });

    let shopTotal = `Total : <span class="float-right"> Rp. ${number_format(totalAllPrice)} | ${totalAllAmount} Item </span>`;
    target.html(result);
    $('#shop-total').html(shopTotal);
}

function showAlert(type, message) {
    let template = `<div class="alert alert-${type}" role="alert" style="position: absolute; right:20px; top: 100px">
        ${message}
    </div>`;

    $('#alert-message').html(template);

    $('.alert').fadeIn().delay(2000).fadeOut();
}


async function order() {
    let getListItem = await getFilteredItem();
    let name = $('#name').val(),
        address = $('#address').val();

    let list = '';

    let message = `Order masuk dari *TokoSimple*

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
*Terima Kasih sudah berbelanja lewat aplikasi TokoSimple*`;

    window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(message)}`, '_blank');
}

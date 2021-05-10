function processPayment(token) {
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf
    };

    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function (response) {
            if(response.data.status){
                toastr.success(response.data.message, 'Sucesso');
                window.setTimeout(function(){
                    window.location.href = urlThanks + "?order=" + response.data.order;
                },2000);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function (response) {
            let selectInstallments = drawSelectInstallments(response.installments[brand]);
            document.querySelector('div.isntallments').innerHTML = selectInstallments;
        },
        error: function () {
        },
        complete: function () {
        },
    });
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for (let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }


    select += '</select>';

    return select;
}

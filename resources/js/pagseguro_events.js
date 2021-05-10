
let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');
cardNumber.addEventListener('keyup', function () {
    if (cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber.value.substr(0, 6),
            success: function (response) {
                let imgFlag = `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png`;
                spanBrand.innerHTML = `<img src="${imgFlag}" alt="bandeira">`;
                document.querySelector('input[name="card_brand"]').value = response.brand.name;
                getInstallments(totalAmountTransation, response.brand.name);
            },
            error: function (error) {
                console.log(error);
            },
            complete: function (complete) {
            }
        });

        let submitButton = document.querySelector('button.process_checkout');

        submitButton.addEventListener('click', function (event) {
            event.preventDefault();
            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name="card_number"]').value,
                brand: document.querySelector('input[name="card_brand"]').value,
                cvv: document.querySelector('input[name="card_cvv"]').value,
                expirationMonth: document.querySelector('input[name="card_month"]').value,
                expirationYear: document.querySelector('input[name="card_year"]').value,
                success: function (response) {
                    processPayment(response.card.token);
                }
            });
        });
    }
});

@extends('layouts.front')
@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-3">Dados para pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post" name="send_checkout">

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card_name">Nome no cartão</label>
                        <input type="text" class="form-control" name="card_name" id="card_name" value="Juciê G. Lima">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card_number">Número do cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number" id="card_number"
                               value="411111111111111">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="card_month">Mês de expiração</label>
                        <input type="text" class="form-control" name="card_month" id="card_month" value="12">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="card_year">Ano de expiração</label>
                        <input type="text" class="form-control" name="card_year" id="card_year" value="2030">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="card_cvv">Código de segurança</label>
                        <input type="text" class="form-control" name="card_cvv" id="card_cvv" value="123">
                    </div>
                    <div class="col-md-12 isntallments form-group"></div>
                </div>

                <button class="btn btn-success process_checkout">Efetuar pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let totalAmountTransation = {{$amount}};
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

                function processPayment(token) {
                    let data = {
                        card_token: token,
                        hash: PagSeguroDirectPayment.getSenderHash(),
                        installment: document.querySelector('.select_installments').value,
                        card_name: document.querySelector('input[name=card_name]').value,
                        _token: '{{csrf_token()}}'
                    };

                    $.ajax({
                        type: 'POST',
                        url: '{{route('checkout.process')}}',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if(response.data.status){
                                toastr.success(response.data.message, 'Sucesso');
                                window.setTimeout(function(){
                                    window.location.href = "{{route('checkout.thanks')}}?order=" + response.data.order;
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
            }
        });
    </script>
@endsection

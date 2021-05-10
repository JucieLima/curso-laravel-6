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
        const urlThanks = '{{route('checkout.thanks')}}';
        const totalAmountTransation = {{$amount}};
        const urlProccess = '{{route('checkout.process')}}';
        const csrf = '{{csrf_token()}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection

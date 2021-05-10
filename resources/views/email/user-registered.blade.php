<h1>Olá, {{$user->name}}, tudo bem? Espero que sim!</h1>
<h3>Obrigado por sua inscrição!</h3>
<p>
    Faça bom  proveito e excelentes compras em nosso marketplace!<br>
    Seu email de cadastro é: <strong>{{$user->email}}</strong><br>
    Por questões de segurança não enviamos sua senha, mas você deve se lembrar!
</p>
<hr>
<p>
    Email enviado em {{date('d/m/Y H:i:s')}}.
</p>

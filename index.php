<?php
error_reporting(0);

require __DIR__.'/vendor/autoload.php';

use \App\Awesome\Economia;
use \App\Communication\Email;

// $address        = 'ramon.webap@gmail.com';
// $subject        = 'Email Cotação Moedas';
// $body           = '<b>Email Cotação Moedas</b>';

// $obEmail = new Email;
// $sucesso = $obEmail->sendEmail($address, $subject, $body);
// echo $sucesso ? 'Menssagem enviado com Sucesso' : $obEmail ->getError();
//PhpMailer com Gmail XOAUTH2


$obEconomia = new Economia;
    if(isset($_POST) && !empty($_POST)) {	
        $moeda1     = $_POST['moedaA'];
        $moeda2     = $_POST["moedaB"];
        $vl_conver  = $_POST["vl_conv"];
        $vl_tx      = $_POST["exampleRadios"];
       
    }else{
        $moeda1     = 'BRL';
        $moeda2     = 'USD';
        $vl_conver  = 1000;
        $vl_tx      = 1;
        
    }


$dadosCotacao = $obEconomia->consultarCotacao($moeda2, $moeda1);

foreach($dadosCotacao as $moeda){
   $compra = $moeda['bid'];
   $venda = $moeda['ask'];
   $variacao = $moeda['varBid'];
   $moeda_destino = $moeda['codein'];
   $moeda_origem = $moeda['code'];
   $desc_moeda = $moeda['name'];   
   $vl = substr($compra, 0, 4);

   

   //TAXA DE COVERSÃO
   if($vl_conver < 3000){
       $tx_conver = 2.0;
   }else{
       $tx_conver = 1.0;
   }
   
   //REGRA TAXA FORMA DE PAGAMENTO
    if($vl_tx  == 1){
        $nm_tp_pg = "Cartão de Crédito";
        $vl_tx = 7.63;
        //valor de compra(menos taxa de forma de pagamento - cartão)
        $vl_compra = $vl_conver -  ($vl_conver * $vl_tx / 100);
        $vl_compra2 = $vl_compra - ($vl_compra * $tx_conver / 100);
    }else{
        $nm_tp_pg = "Boleto";
        $vl_tx = 1.45; 
        //valor de compra(menos taxa de forma de pagamento - boleto)
        $vl_compra = $vl_conver - ($vl_conver * $vl_tx / 100); 
        $vl_compra2 = $vl_compra - ($vl_compra * $tx_conver / 100);
    }

   //SEPARANDO AS DIFEREÇAS DAS TAXAS    
   $vl_final_conv = $vl_conver - $vl_compra2; //valor da diferenaça da taxa de conversão
   $vl_moeda_compra = $vl_compra2 / $vl; //valor que restou apos os tadas as taxas
   $taxa_final = $vl_conver - $vl_compra; // valor da diferença da taxa de forma de pagamento escolhida
   
   
   //$taxa = $vl_conver - $tx_pag;
//    echo 'valor de compra final' .$vl_compra.'<br>';
//    echo 'valor de compra final2' .$vl_compra2.'<br>';
//    echo 'valor taxa' .$vl_tx .'<br>';
//    echo 'valor moeda compra' .$vl_moeda_compra.'<br>';
//    echo 'valor final taxa ' .$taxa_final.'<br>';
   //echo $tx_pag;
  
   
}


?>
<html lang="pt">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Oliveira Trust PHP Money Converter</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 

    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
  
    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="app/img/images.jpg" alt="" width="172" height="92">
    <h2>Oliveira Trust PHP Money Converter</h2>
    <p class="lead">Desafio para candidatos à vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).</p>
  </div>
  
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Parâmetros de saída:</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $moeda_origem; ?></h6>
            <small class="text-muted"><?php echo $desc_moeda; ?></small>
          </div>
          <span class="text-muted"><?php echo 'R$'.number_format($compra, 2, ',', '.');?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $moeda_destino; ?></h6>
            <small class="text-muted">Moeda de Origem</small>
          </div>
          <span class="text-muted">BRL</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Valor para conversão</h6>
            <small class="text-muted">Valor Total</small>
          </div>
          <span class="text-muted"><?php echo 'R$'.number_format($vl_compra2, 2, ',', '.'); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Forma de pagamento</h6>
            <small class="text-muted"><?php echo $nm_tp_pg; ?></small>
          </div>
          <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
  <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
</svg></span>
        </li>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Taxas de pagamento</h6>
            <small><?php echo $nm_tp_pg. '+ Taxa de Conversão'; ?></small>
          </div>
          <span class="text-success"><?php echo 'R$' .number_format($taxa_final, 2, ',', '.'). '+ R$' .number_format($vl_final_conv, 2, ',', '.');?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (<?php echo $moeda_origem;?>)</span>
          <small>Valor comprado</small>
          <strong><?php echo $moeda_origem .number_format($vl_moeda_compra, 2, ',', '.');?></strong>
        </li>
      </ul>

      <form class="card p-2" >
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Seu email">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Enviar Email</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Escolha moeda de compra</h4>
      <form class="needs-validation" action="index.php" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Moeda Origem</label>
            <input type="text" class="form-control" id="moedaA" name="moedaA" placeholder="BRL" value="BRL" required>
            <div class="invalid-feedback">
              Campo obrigatório!
            </div>
          </div>
          <div class="col-md-6 mb-3">
          <label for="country">Moeda Destino</label>
            <select class="custom-select d-block w-100" id="moedaB" name="moedaB" required>
              <option value="USD">DOLAR</option>
              <option value="EUR">EURO</option>
              <option value="BTC">BITCOIN</option>
            </select>
            <div class="invalid-feedback">
            Campo obrigatório!
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
          <label for="country">Valor de Compra</label>
            <div class="input-group mb-3">            
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                    <input type="number" class="form-control" min="1000" max="100000" name="vl_conv" id="valor_bruto" aria-label="Amount (to the nearest dollar)" required>
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="invalid-feedback">
            Campo obrigatório!
            </div>
          </div>        
         </div>        
         <label for="country">Formas de Pagamento</label>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="exampleRadios" type="radio" class="custom-control-input" value="1" checked required>
                    <label class="custom-control-label" for="credit">Cartão de Crédito</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="exampleRadios" type="radio" class="custom-control-input" value="2" required>
                    <label class="custom-control-label" for="debit">Boleto</label>
                </div> 
            </div>         
        </div>
    </div>
            <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="moeda_padrao();">Finalizar Compra</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.js"></script></body>
        <script>
        function moeda_padrao(){
            var moeda = document.getElementById("moedaA").value;
            if(moeda != 'BRL'){
                alert('Somente a moeda BRL')
            }      

        
            var valor = document.getElementById("valor_bruto").value;
            if(valor < 1000){return false;
                alert('Valor deve ser maior que R$ 1000,00!');
            }else if(valor > 100000){
                alert('Valor deve ser menor que R$ 100.000!');
               
            }
        }
   
           
        
    </script>
        </html>

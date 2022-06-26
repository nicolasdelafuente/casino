<?php
    $title = $data['title'];
    include_once 'views/include/header.php';
?>

  <FORM method="POST">
    <input type="submit" name="Submit3" value="Destroy Session">
  </FORM>
  

  <div class="container ">
    <div class="row mt-1 d-flex text-center justify-content-center">
      <div class="col-md-10">

        <div id="liveAlertPlaceholder"></div>

        <div class="row">
          <h2>Tragamonedas</h2>
        </div>
        <div class="row">
          <h4>Crédito: </h4>
          <h2>$ <span id="saldo"> 500 </span></h2>
        </div>
        <div class="row d-flex justify-content-between"">
          <div class="card text-white bg-primary mb-3" id="card_1" style="max-width: 18rem;">
              <div class="card-header"><h5 class="card-title">SLOT 1</h5></div>
              <div class="card-body ">
                <h5 class="card-title"> Número </h5>
                <h1 class="card-text">1</h1>
              </div>
          </div>
          <div class="card text-white bg-secondary mb-3" id="card_2" style="max-width: 18rem;">
            <div class="card-header"><h5 class="card-title">SLOT 2</h5></div>
              <div class="card-body">
                <h5 class="card-title"> Número </h5>
                <h1> 2 </h1>
              </div>
          </div>
          <div class="card text-white bg-success mb-3" id="card_3" style="max-width: 18rem;">
            <div class="card-header"><h5 class="card-title">SLOT 3</h5></div>
              <div class="card-body">
                <h5 class="card-title"> Número </h5>
                <h1> 3 </h1>
              </div>
          </div>
        </div>

        <div class="row d-flex justify-content-between"">
          <button type="button" class="btn btn-warning" id="tirar">Tirar</button>
        </div>        
      </div>
    </div>
  </div>


  
    
<script>
  window.onload = inicio;

  colores = {
        "0": "card text-white bg-primary mb-3",
        "1": "card text-white bg-secondary mb-3",
        "2": "card text-white bg-success mb-3",
        "3": "card text-white bg-danger mb-3",
        "4": "card text-white bg-warning mb-3",
        "5": "card text-white bg-info mb-3",
        "6": "card bg-light mb-3",
        "7": "card bg-light mb-3"
  }

  var card1 = document.getElementById("card_1");
  var card2 = document.getElementById("card_2");
  var card3 = document.getElementById("card_3");
  var saldo = document.getElementById("saldo");
  var alerta = document.getElementById("alerta");
  
  var credito = Math.floor(Math.random()*4)+9;
  var numeros = [1,2,3,4,5,6,7];

  var premios=[];
  var numeros_actuales = [];

  function inicio() {
    document.getElementById("tirar").onclick=lanzar_inicio;
  }

  function lanzar_inicio() {
    // TODO No puedo ocultar las alertas 
    //ocultar_alerta()
  
    if(saldo_actual() < 10) {
      return alert('No tienes saldo para volver a jugar', 'danger')
    }

    abonar_jugada(10);


    numeros_actuales = [];
    for (let i = 0; i < 3; i++) {
      numeros_actuales.push(escoger_numero());
    }
    
    actualizar_slot(card1, numeros_actuales[0]);
    actualizar_slot(card2, numeros_actuales[1]);
    actualizar_slot(card3, numeros_actuales[2]);

    comparar(numeros_actuales);
    
  }

  function escoger_numero() {
    var azar = Math.floor(Math.random()*numeros.length);
    return azar;
  }

  function actualizar_slot(elemento, valor) {
    actualizar_valor(elemento, valor);
    actualizar_color(elemento, valor);
  }

  function actualizar_valor(elemento, valor) {
    elemento.children[1].children[1].innerHTML = valor;
  }

  function actualizar_color(elemento, valor) {
    elemento.className = colores[valor];
  }

  function comparar(valores) {
    
    if((valores[0] == valores[1]) && (valores[0] == valores[2])) {
      let mensaje = mensaje_ganador(20);
      recibir_premio(25);
      return alert('Felicitaciones !!!, ganaste $25', 'success');
    }

    if(valores[0] == valores[1] || valores[0] == valores[2] || valores[1] == valores[2]) {
      let mensaje = mensaje_ganador(10);
      recibir_premio(5);
      return alert('Felicitaciones, ganaste $5', 'primary');
    }
      return alert('Intentalo nuevamente.', 'secondary');
  }

  function mensaje_ganador(cantidad) {
    return `Has ganado ${cantidad} monedas.`
  }

  function saldo_actual() {
    return saldo.innerHTML;
  }

  function abonar_jugada(importe) {
    importe = Number(importe) * (-1)
    actualizar_saldo(importe)
  }

  function recibir_premio(importe) {
    actualizar_saldo(importe)
  }

  function actualizar_saldo(importe) {
    saldo.innerHTML = (Number(saldo.innerHTML) + importe)
  }

  function recibir_premio(importe) {
    actualizar_saldo(importe)
  }



const  alertPlaceholder = document.getElementById('liveAlertPlaceholder')

const alert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert" style="display:block;">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

function ocultar_alerta() {
  alertPlaceholder.style.display = "none";
}

</script>
    
<?php include_once 'views/include/footer.php'?>




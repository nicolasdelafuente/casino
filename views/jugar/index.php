<?php
    $title = $data['title'];
    include_once 'views/include/header.php';
?>

  <FORM method="POST">
    <input type="submit" name="Submit3" value="Destroy Session">
  </FORM>
  

  <div class="container ">
    <div class="row mt-3 d-flex text-center justify-content-center">
      <div class="col-md-10">
        <div class="row">
          <h1>Tragamonedas</h1>
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
          <button type="button" class="btn btn-warning" id="tirar">Warning</button>
        </div>        
      </div>
    </div>
  </div>

  
    
<script>
  window.onload = inicio;

  var card1 = document.getElementById("card_1");
  var card2 = document.getElementById("card_2");
  var card3 = document.getElementById("card_3");
  
  var credito = Math.floor(Math.random()*4)+9;
  var numeros = [1,2,3,4,5,6,7,8,9];

  var premios=[];
  var numeros_actuales = [];

  function inicio() {
    document.getElementById("tirar").onclick=lanzar_inicio;
  }

  function lanzar_inicio() {
    numeros_actuales = [];
    for (let i = 0; i < 3; i++) {
      numeros_actuales.push(escoger_numero());
    }
    //alert(numeros_actuales);

    cambiar_numero(card1, numeros_actuales[0]);
    cambiar_numero(card2, numeros_actuales[1]);
    cambiar_numero(card3, numeros_actuales[2]);

    cambiar_numero(card1)
  }

  function lanzar_uno() {

  }

  function escoger_numero() {
    var azar = Math.floor(Math.random()*numeros.length);
    return azar;
  }


  function cambiar_numero(elemeto, valor) {
    elemeto.children[1].children[1].innerHTML = valor;
  }

  function cambiar_numero(elemeto) {
    colores = {
        "1": "card text-white bg-primary mb-3",
        "2": "card text-white bg-secondary mb-3",
        "3": "card text-white bg-success mb-3",
        "4": "card text-white bg-danger mb-3",
        "5": "card text-white bg-warning mb-3",
        "6": "card text-white bg-info mb-3",
        "7": "card bg-light mb-3",
        "8": "card bg-light mb-3"
      }

    console.log(elemeto)
  }
  

  function mostrar_imagen() {

  }

  function comparar() {

  }

  function actualizar() {

  }

  function mostrar_mensaje() {

  }

  function cerrar() {

  }

</script>
    
<?php include_once 'views/include/footer.php'?>




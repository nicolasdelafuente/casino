<?php
    $title = $data['title'];
    $movimientos = $data['transactions'];
    $monto = $data['amount'];

    $dineroApostado = 0;
    $dineroRetornado = 0;
    $dineroGanado = 0;
    
    foreach ($movimientos as $movimiento => $value)  {
      if ($value->getCategoryId() == 3) {
        $dineroApostado = ($dineroApostado + $value->getAmount());
      }

      if ($value->getCategoryId() == 4) {
        $dineroRetornado = ($dineroRetornado + $value->getAmount())*-1;
      }
    }
    $dineroGanado = $dineroApostado - $dineroRetornado;

    $dineroApostado =  $dineroApostado * -1;

    

    if(isset($_POST['Submit3']))
    { 
    session_destroy();
    }

    include_once 'views/include/header.php'
?>



<form method="POST">
  <input type="submit" name="Submit3" value="Destroy Session">
</form>
    <div class="container ">
      <div class="row mt-3 d-flex text-center justify-content-center">
        <div class="col-md-10">
          <div class="row">
            <h1>Este es la vista del Dashboard</h1>
            <p><?php $this->showMessages() ?></p>
          </div>
          <div class="row d-flex justify-content-between"">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header"><h5 class="card-title">SALDO</h5></div>
                <div class="card-body ">
                  <h5 class="card-title">
                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                      </svg>
                  </h5>
                  <h1 class="card-text"><?php echo number_format($monto,2) ?></h1>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header"><h5 class="card-title">DINERO APOSTADO</h5></div>
                <div class="card-body">
                  <h5 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-emoji-wink" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm1.757-.437a.5.5 0 0 1 .68.194.934.934 0 0 0 .813.493c.339 0 .645-.19.813-.493a.5.5 0 1 1 .874.486A1.934 1.934 0 0 1 10.25 7.75c-.73 0-1.356-.412-1.687-1.007a.5.5 0 0 1 .194-.68z"/>
                    </svg>
                  </h5>
                  <h1 class="card-text"><?php echo number_format($dineroApostado,2) ?></h1>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
              <div class="card-header"><h5 class="card-title">DINERO GANADO</h5></div>
                <div class="card-body">
                  <h5 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                      <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                    </svg>
                  </h5>
                  <h1 class="card-text"><?php echo number_format($dineroGanado,2) ?></h1>
                </div>
            </div>
          </div>
          <div class="row text-start">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Movimiento</th>
                  <th scope="col" class="text-end">Importe</th>
                  <th scope="col" class="text-end">Saldo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                    $saldo = 0;
                    foreach ($movimientos as $movimiento => $value) { ?>
                      <tr>
                        <?php $saldo = $saldo + $value->getAmount() ?>
                        <td>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?php echo $value->getColor() ?>" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                          </svg>
                        </td>
                        <td><?php echo $value->getDate() ?></td>  
                        <td><?php echo $value->getNameCategory() ?></td> 
                        <td class="text-end">$ <?php echo number_format($value->getAmount(),2) ?></td>
                        <td class="text-end">$ <?php echo number_format($saldo,2) ?></td>
                        <td class="text-end">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?php echo $value->getColor() ?>"  class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                          </svg>
                        </td>
                      </tr>
                  <?php } ?>              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  
    
    
<?php include_once 'views/include/footer.php'?>


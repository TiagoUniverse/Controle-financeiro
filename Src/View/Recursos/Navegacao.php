<!-- Header -->
<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>

      <?php
      if (isset($_SESSION['nomeMes'])  && isset($_SESSION['ano']) ) {
      ?>
        <span class="fs-4">Controle monetário: <b> <?php echo $_SESSION['nomeMes']; ?> de <?php echo $_SESSION['ano']; ?>  </b> </span>
      <?php
      } else {
      ?>
        <span class="fs-4">Controle monetário</span>
      <?php
      }
      ?>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="Home.php" class="nav-link active" aria-current="page">Despensas</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Poupança</a></li>
      <!-- <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li> -->

      <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="#">Perfil</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Sair</a></li>
        </ul>
      </div>
    </ul>
  </header>
</div>
<?php
if ((isset($_POST['nomeMes']) && $_POST['ano'] ) || (isset($_POST['nomeMes']) && $_POST['ano'] == "" ) ){
  ?>
  <a href="home.php" class="botao-voltar">Voltar</a>
  <?php
}
?>


<footer>
  Tiago Universe, PE 2023.
</footer>
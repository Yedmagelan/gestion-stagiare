<nav class="navbar navbar-expand-md fixed-top fixed-top navbar-dark navigation1">
    <div class="container-fluid">
    <img src="../img/Logo2.jpg" alt="logo communautaire" width="50" height="45">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">

        <?php if($_SESSION["role"]=="ADMIN"){ ?>

        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php"><i class="fa fa-users"></i>Utilisateurs</a>
          </li>

          <?php } ?>
			
          <li class="nav-item">
            <a class="nav-link active" href="etudiants.php">Etudiants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="matieres.php"> Matières </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="inscriptions.php"><i class="fa fa-user"></i>Inscriptions</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link active" href="professeurs.php">Professeurs</a>
          </li>
        </ul>
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-light text-decoration-none dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="rounded-circle me-2" src="../img/<?php echo $_SESSION["photo"]; ?>" alt="logo communautaire" width="30" height="30">
					<?php echo  "    ".$_SESSION["login"]; ?>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
          <li><a class="dropdown-item active" href="profil.php" aria-current="page"> <strong><i class="fa fa-user"></i> Profile</strong> </a></li>
          <li><a class="dropdown-item" href="actions.php?action=sedeconnecter"> Se deconnecter </a></li>
          
        </ul>
      </div>
      
    </div>
  </nav>
</header>
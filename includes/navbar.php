<!-- <?php 
if (!isset($_SESSION['authAdmin'])){
$idUser=$_SESSION['ID_User']; 
}
?> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">JobBoard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link"  href="index.php">Les articles</a>
        </li>
        <!-- <?php if (!isset($_SESSION['authAdmin'])){?> -->
        
        <li class="nav-item">
          <a class="nav-link" href="publish-article.php">Publier un article</a>
        </li>
        
      </ul>
      <form class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="profile.php?id=<?= $_SESSION['ID_User'];?>">Mes articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ProfileSettings.php?id=<?=$idUser?>">Compte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="actions/users/logoutAction.php">Deconnexion</a>
        </li>

        </ul>
      </form>
      <!-- <?php }else { ?> -->
        <li class="nav-item">
          <a class="nav-link"  href="showAllUsers.php">Les utilisateurs</a>
        </li>
        <form class="d-flex">
        <li class="nav-item">
          <a class="nav-link" href="actions/users/logoutAction.php">Deconnexion</a>
        </li>
      </form>
     <!-- <?php } ?>  -->

    </div>
  </div>
</nav>
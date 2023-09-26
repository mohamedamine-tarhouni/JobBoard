<?php
 require('actions/users/register_parse.php'); 
 include 'actions/offers/loadFilters_Actions.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

<body>
    <div class="container">
        <div class="form_div">
            <form method="POST">
                <?php if (isset($errorMsg)) {
                    echo "<font color=red>" . $errorMsg . "</font>";
                } ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur : </label>


                    <input type="text" class="form-control" id="username" name="username" value="<?php
                                                                                                    if (isset($username)) {
                                                                                                        echo $username;
                                                                                                    }
                                                                                                    ?>" aria-describedby="emailHelp">


                </div>
                <?php if (isset($errorMsg_Username)) {
                    echo "<font color=red>" . $errorMsg_Username . "</font>";
                } ?>
                <div class="mb-3">
                    <label for="mail" class="form-label">E-Mail : </label>

                    <input type="email" class="form-control" id="mail" name="mail" value="<?php
                                                                                            if (isset($mail)) {
                                                                                                echo $mail;
                                                                                            }
                                                                                            ?>" aria-describedby="emailHelp">

                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <?php if (isset($errorMsg_Mail)) {
                    echo "<font color=red>" . $errorMsg_Mail . "</font>";
                } ?>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe : </label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php
                                                                                                        if (isset($password_verif)) {
                                                                                                            echo $password_verif;
                                                                                                        }
                                                                                                        ?>">
                </div>
                <?php if (isset($error_MDP)) {
                    echo "<font color=red>" . $error_MDP . "</font>";
                } ?>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe : </label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <div class="mb-3">
                <label for="enteprise_value">Entreprise : </label>
                <select name="enterprise" id="enteprise_value">
                    <?php foreach($enterprises as $enterprise) { ?> 
                        <option value="<?= $enterprise['id'] ?>"><?= $enterprise['enterprise_name'] ?></option>
                        <?php } ?>
                </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">S'inscrire</button>
                <a href="user_login.php">
                    <p>J'ai déjà un compte </p>
                </a>
            </form>
        </div>
    </div>
</body>

</html>
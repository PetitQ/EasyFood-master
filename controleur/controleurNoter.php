<?php

// visualiser note
if (empty($_GET['valider']) || $_GET['valider'] == 1)
{
  if(empty($_GET['resto']) && empty($_GET['r']) && empty($_GET['q']) && empty($_GET['l']) && empty($_GET['c'])){
    $lesRestos = NoteDAO::selectLesRestos($_SESSION['identite'][0]);
    $formListeResto = "";
    for ($i=0; $i < sizeof($lesRestos); $i++) {
      $nomResto = explode(";", $lesRestos[$i]);
      $form = new Formulaire("POST", "index.php?menuPrincipal=Noter&valider=1&resto=".$nomResto[0]. "&commande=" . $nomResto[2], "formNoter", "note");
      $form->ajouterComposantLigne($form->creerA($nomResto[1]));
      $form->ajouterComposantLigne($form->creerInputSubmit($nomResto[0], $nomResto[0], "Voter"));
      $form->ajouterComposantTab();
      $form->creerFormulaire();
      $formListeResto .= $form->afficherFormulaire();
    }
  }
  else{
    // si une etoile a été cliqué on met la valeur dans son $_SESSION
    if (isset($_GET['r'])){
      $_SESSION['r'] = $_GET['r'];
    }
    elseif (isset($_GET['q'])) {
      $_SESSION['q'] = $_GET['q'];
    }
    elseif (isset($_GET['l'])) {
      $_SESSION['l'] = $_GET['l'];
    }
    elseif (isset($_GET['c'])) {
      $_SESSION['c'] = $_GET['c'];
    }
    // on récupère l'id du resto
    if (isset($_GET['resto'])){
      $_SESSION['resto'] = $_GET['resto'];
      $idResto = $_GET['resto'];
    }
    else{
      $idResto = $_SESSION['resto'];
    }
    // on récupère le nom du resto avec un select dans la bdd
    $nomResto = NoteDAO::selectRestoIdResto($_SESSION['identite'][0], $idResto);

    $formCom = new Formulaire("POST","index.php?menuPrincipal=Noter&valider=2&resto=".$idResto. "&commande=" . $_GET['commande'],"formNoter","note");
    $formCom->ajouterComposantLigne($formCom->creerA($nomResto));
    $formCom->ajouterComposantTab();

    // rapidite
    $formCom->ajouterComposantLigne($formCom->creerA("Rapidité:"));
    $formCom->ajouterComposantTab();
    $cp_star = "r";
    if (empty($_SESSION[$cp_star])) {
      $_SESSION[$cp_star] = 0;
    }
    $formCom->ajouterComposantLigne($formCom->afficherCompo(Star::afficherStar($cp_star)));
    $formCom->ajouterComposantTab();

    // qualite
    $formCom->ajouterComposantLigne($formCom->creerA("Qualité:"));
    $formCom->ajouterComposantTab();
    $cp_star = "q";
    if (empty($_SESSION[$cp_star])) {
      $_SESSION[$cp_star] = 0;
    }
    $formCom->ajouterComposantLigne($formCom->afficherCompo(Star::afficherStar($cp_star)));
    $formCom->ajouterComposantTab();

    // tps livraison
    $formCom->ajouterComposantLigne($formCom->creerA("Temps de livraison:"));
    $formCom->ajouterComposantTab();
    $cp_star = "l";
    if (empty($_SESSION[$cp_star])) {
      $_SESSION[$cp_star] = 0;
    }
    $formCom->ajouterComposantLigne($formCom->afficherCompo(Star::afficherStar($cp_star)));
    $formCom->ajouterComposantTab();

    // cout
    $formCom->ajouterComposantLigne($formCom->creerA("Coût:"));
    $formCom->ajouterComposantTab();
    $cp_star = "c";
    if (empty($_SESSION[$cp_star])) {
      $_SESSION[$cp_star] = 0;
    }
    $formCom->ajouterComposantLigne($formCom->afficherCompo(Star::afficherStar($cp_star)));
    $formCom->ajouterComposantTab();

    // commentaire
    $formCom->ajouterComposantLigne($formCom->creerA("Commentaire"));
    $formCom->ajouterComposantTab();
    $formCom->ajouterComposantLigne($formCom->creerInputGrandTexte("descrip", 8, 40, ""));
    $formCom->ajouterComposantTab();
    $formCom->ajouterComposantLigne($formCom->creerInputSubmit("note", "note", "Noter"));
    $formCom->ajouterComposantTab();
    $formCom->creerFormulaire();
  }
  include_once "vue/vueNoter.php";
}
// mettre a jour
else
{
  $idResto = $_GET['resto'];
  $nomCommand = $_GET['commande'];
  $commentaire = $_POST['descrip'];
  NoteDAO::updateNote($_SESSION['r'], $_SESSION['q'], $_SESSION['l'],
                            $_SESSION['c'], $nomCommand, $commentaire, $idResto, $_SESSION['identite'][0]);
  (isset($_SESSION['r']))?$_SESSION['r'] = 0:0;
  (isset($_SESSION['q']))?$_SESSION['q'] = 0:0;
  (isset($_SESSION['l']))?$_SESSION['l'] = 0:0;
  (isset($_SESSION['c']))?$_SESSION['c'] = 0:0;
  if (NoteDAO::selectResto($_SESSION['identite'][0])){
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Noter";';
    echo '</script>';
  }
  else {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Accueil";';
    echo '</script>';
  }
}
 ?>

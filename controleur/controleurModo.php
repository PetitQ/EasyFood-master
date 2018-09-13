<?php
// si il accepte le vote alors la note est accepté et la page et rechargé
if (isset($_POST['accepter'])){
  $noteAMode = NoteDAO::selectModeNote();
  $idCommande = $noteAMode[0]['IDC'];
  NoteDAO::updateModeSee($idCommande, 2);
  // echo '<script type="text/javascript">';
  // echo 'window.location.href = "index.php?menuPrincipal=Modo";';
  // echo '</script>';
}
// note refusé
elseif (isset($_POST['refuser'])) {
  $noteAMode = NoteDAO::selectModeNote();
  $idCommande = $noteAMode[0]['IDC'];
  NoteDAO::updateModeSee($idCommande, 3);
  // echo '<script type="text/javascript">';
  // echo 'window.location.href = "index.php?menuPrincipal=Modo";';
  // echo '</script>';
}

// selectionner tous les votes non vérifiés
$noteAMode = NoteDAO::selectModeNote();
// s'il n'y a plus de vote on revient à l'accueil
if (empty($noteAMode)){
  echo '<script type="text/javascript">';
  echo 'window.location.href = "index.php?menuPrincipal=Accueil";';
  echo '</script>';
}
// sinon on affiche le vote
else {
  $nomR = $noteAMode[0]['NOMR'];
  $noteTemps = $noteAMode[0]['NOTETEMP'];
  $noteQualite = $noteAMode[0]['NOTEQUALITE'];
  $noteR = $noteAMode[0]['NOTERAPIDITE'];
  $noteCout = $noteAMode[0]['NOTECOUT'];
  $commentaire = $noteAMode[0]['COMMENTAIRE'];

  $formModo = new Formulaire("POST","index.php?menuPrincipal=Modo",
  "formModo","modo");
  $formModo->ajouterComposantLigne($formModo->creerA("Le restaurant \"<font color='orange'>"
                        . $nomR . "</font>\" a obtenu les notes suivantes par le client \"<font color='orange'>" .
                        $noteAMode[0]['IDU'] . "</font>\":"));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerA("Note temps: " . Star::afficherStarID($noteTemps)));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerA("Note qualité: " . Star::afficherStarID($noteQualite)));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerA("Note sur la rapidité: " . Star::afficherStarID($noteR)));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerA("Note sur le coût: " . Star::afficherStarID($noteCout)));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerA("Commentaire: </br><font color='orange'>" . $commentaire . "</font>"));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerInputSubmit("accepter", "accepter",
              "Accepter"));
  $formModo->ajouterComposantTab();
  $formModo->ajouterComposantLigne($formModo->creerInputSubmit("refuser", "refuser",
              "Refuser"));
  $formModo->ajouterComposantTab();
  $formModo->creerFormulaire();
  include_once 'vue/vueModo.php';
}

?>

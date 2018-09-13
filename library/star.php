<?php

/**
 * star
 */
class Star
{

  /*
  * $star = id du vote
  * nombre d'étoile indiqué par $_SESSION[$star]
  */
  public static function afficherStar($star)
  {
    $result = "";
    $nbStar = $_SESSION[$star];
    $e = 1;
    if ($nbStar > 0) {
      if ($nbStar>0) {
        $e += 1;
        $result .= "<a href=?" . $star . "=1&commande=" . $_GET['commande']."><img src='image/star.png' width='5%' height='5%'></a>";
      }
      if ($nbStar>1) {
        $e += 1;
        $result .= "<a href=?" . $star . "=2&commande=" . $_GET['commande']."><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>2) {
        $e += 1;
        $result .= "<a href=?" . $star . "=3&commande=" . $_GET['commande']."><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>3) {
        $e += 1;
        $result .= "<a href=?" . $star . "=4&commande=" . $_GET['commande']."><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>4) {
        $e += 1;
        $result .= "<a href=?" . $star . "=5&commande=" . $_GET['commande']."><img src='image/star.png' width='5%' height='5%'></a>";
      }
      // si $e est inférieur à 6 on ajoute des étoiles vides pour avoir 5 étoiles
      for ($i = $e;$i<6;$i++){
        $result .= "<a href=?" . $star . "=" . $i . "&commande=" . $_GET['commande']."><img src='image/empty.png' width='5%' height='5%'></a>";
      }
    }
    // si le vote est à zéro
    else {
      for ($i = $e;$i<6;$i++){
        $result .= "<a href=?" . $star . "=" . $i . "&commande=" . $_GET['commande']."><img src='image/empty.png' width='5%' height='5%'></a>";
      }

    }
    return $result;
  }

  /*
  * $nbStar = indiquer le nombre d'étoile sur 5
  */
  public static function afficherStarID($nbStar)
  {
    $result = "";
    $e = 0;
    if ($nbStar > 0) {
      if ($nbStar>0) {
        $e += 1;
        $result .= "<a><img src='image/star.png' width='5%' height='5%'></a>";
      }
      if ($nbStar>1) {
        $e += 1;
        $result .= "<a><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>2) {
        $e += 1;
        $result .= "<a><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>3) {
        $e += 1;
        $result .= "<a><img src='image/star.png' width='5%' height='5%'></a>";  }
      if ($nbStar>4) {
        $e += 1;
        $result .= "<a><img src='image/star.png' width='5%' height='5%'></a>";
      }
      for ($i = $e;$i<5;$i++){
        $result .= "<a><img src='image/empty.png' width='5%' height='5%'></a>";
      }
    }
    else {
      for ($i = $e;$i<5;$i++){
        $result .= "<a><img src='image/empty.png' width='5%' height='5%'></a>";
      }

    }
    return $result;
  }

}


 ?>

<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>
    <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">

<div class="styleNote">

</head>

<body>
<?php

if (isset($formCom)){
  echo $formCom->afficherFormulaire();
}
if (isset($formListeResto)){
  echo $formListeResto;
}

 ?>
</br>
</br>
  <!-- <a href="image\left.png"><img src="image\left.png" width="10%" height="10%"></a>
  <a href="image\right.png"><img src="image\right.png" width="10%" height="10%"></a> -->
</body>
</main>

</div>

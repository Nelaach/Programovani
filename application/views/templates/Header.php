<html>
    <head>
        <title>Kurzy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
    </head>

    <body>
        <?php
        $email = $this->session->userdata('email');
            $ucitel_kurz = $this->db->query('SELECT kurz.nazev FROM kurz INNER JOIN uzivatel ON kurz_idKurz = idKurz where uzivatel.funkce = "ucitel" and uzivatel.email="' . $email . '"')->result();
            $funkce = $this->db->query('SELECT funkce FROM uzivatel where email="' . $email . '"')->result();
            $student_kurz = $this->db->query('SELECT kurz.nazev as nazev, kurz.idKurz as idKurz FROM kurz INNER JOIN uzivatel ON kurz_idKurz = idKurz where uzivatel.funkce = "student" and uzivatel.email="' . $email . '"')->result();
        
        foreach ($funkce as $key) {
            $oFunkce = $key->funkce;
        }


        ?>

        <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1 fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <?php if ($oFunkce == "ucitel") { ?> 
                        <?php if (!$ucitel_kurz) { ?> 
                            <li class="nav-item"> <a class="nav-link" <a href="<?php echo base_url('main/NovyKurz'); ?>">Nový kurz</a></li>                
                        <?php } ?>
                    <?php } ?>

                    <?php foreach ($ucitel_kurz as $kurz) { ?>
                        <?php if ($kurz) { ?> 
                            <li class="nav-item"> <a class="nav-link" <a href="<?php echo base_url('main/UcitelKurz'); ?>"><?= $kurz->nazev ?></a></li>                

                        <?php } ?>
                    <?php } ?>
                    <li class="nav-item"> <a class="nav-link" <a href="<?php echo base_url('main/PrehledKurzu'); ?>">Přehled Kurzů</a></li>
                    
                    <?php if ($oFunkce == "student") { ?> 
                        <?php foreach ($ucitel_kurz as $kurz) { ?>
                    <?php if (!is_null($student_kurz)) { ?> 
                            <li class="nav-item"> <a class="nav-link" <a href="<?php echo base_url('main/Detailne_PrehledKurzu/'.$kurz->idKurz); ?>"><?= $kurz->nazev ?></a></li>                

                        <?php } }}?>
 

                </ul>

                <ul class="navbar-nav">
                    <form class="form-inline my-2 my-lg-0">

                        <li class="nav-item">  <?php echo $email; ?></li>
                        <li class="nav-item"> <a class="nav-link"     <a href='<?php echo base_url() . "index.php/Main/logout"; ?>'>Odhlásit se</a>  </li>

                    </form>            

                </ul>






            </div>
        </nav>
    </body>
</html>
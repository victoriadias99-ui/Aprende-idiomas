<?php {

    function OpenCon() {
        $cnx = new PDO('mysql:host=localhost;dbname=aprendee_idiomas_latam;charset=utf8mb4', 'aprendee_idiomas_admin', 'aprendee_idiomas_admin');
        return $cnx;
    }

}
?>
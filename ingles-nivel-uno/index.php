<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
//    echo "<pre>";
//    print_r($_SERVER);
//    echo "</pre>";
}

$dirpage = '../';
$titulo = 'Aprende Ingles desde 0';
$curso = 'ingles_uno';

require("../a-includes/Keys.php");
include("../a-includes/funcionsDB.php");
include("../a-includes/logicparametros.php");
require ("../a-includes/Funciones.php");

//echo 'curso = ' . $curso . '<br>';
//echo 'moneda = ' . $moneda . '<br><br><br>';
$productoC1 = getDataProducto($curso, $moneda, $country_code);
//echo "<pre>";
//print_r($productoC1);
//echo "</pre>";
$simbolo = $productoC1['producto']['SIMBOLO'];
$monedaOficial = $productoC1['producto']['MONEDA'];
$precioCursoOficial = Funciones::getFormatMoneda($productoC1['producto']['PRECIO'], $simbolo, $productoC1['producto']['MONEDA']);
$value = $valPrecio = $productoC1['producto']['PRECIO_DESC'];
$precioCurso = Funciones::getFormatMoneda($valPrecio, $simbolo, $productoC1['producto']['MONEDA']);
$porcentaje = '50%';

$urlCheckout = 'checkout.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Aprende Idiomas - Cursos Online</title>
        <?php include('../a-pages/header.php') ?>
    </head>
    <body style="font-family: montserrat_regular;">
        <header>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <a href="./" target="_blank"><img src="img/logo.jpg" alt="logo" class="img-fluid"> </a>
                    </div>
                    <div class="col-md-3 hdphone">
                        <p> Aprende a distancia</p>
                    </div>
                    <div class="col-md-3 hdphone">
                        <img src="../img/front_pay.png" alt="security" class="img-fluid">
                    </div>
                    <div class="col-md-3 cta-button  col-sm-6 col-6">
                        <a class="hvr-sweep-to-right" href="checkout.php">Lo quiero</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- BANNER TIMER Temporizador -->
        <div class="container-fluid fixed-top m-0 py-2 d-lg-block d-none" id="banner-timer">
            <div class="row m-0 p-0 justify-content-center align-items-center">
                <div class="col-auto m-0 p-0">
                    <h5 class="mb-0  pe-1">PROMO ESPECIAL PARA ALUMNOS NUEVOS 🎉 </h5>
                </div>
                <div class="col-auto m-0 p-0">
                    <div id="temporizador"></div>
                </div>
            </div>
        </div>
        <!-- FIN BANNER TIMER Temporizador -->

        <!-- Website Sections -->
        <!-- Top Product Banner -->
        <section class="top-product  bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-5" style="">
                        <div class=" py-auto">
                            <img src="img/producto1.jpg" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" alt="curso de power bi">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading ">
                            <h3 style="color:black;">Curso online a distancia</h3>
                            <h1 class="mt-4  " style=""><b>APRENDE <span style="font-family: montserrat_black ;">INGLÉS DESDE CERO!</span></b></h1>
                        </div>
                        <div class="feature-list mt-4" >
                            <ul class="font-weight-light" style="font-family: montserrat_light ;" >
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;" ><i class="fas fa-check-circle text-dark"></i> + 45 clases paso a paso!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Descargá el curso y miralo sin conexión a internet!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Acceso para siempre al curso</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Ayuda de los profesores online </li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-dark"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-dark"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>			
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_regular;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "><?= $precioCurso ?></span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Latina. El precio se convierte automaticamente a su moneda local.</p>

                        </div>
                        <div class="call-button mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top  wow flipInX animated shadow text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color:#f3c910;">Lo quiero</a>
                                </div>
                                <div class="col-md-6 payments">
                                    <img src="../img/front_pay.png" class="img-fluid wow flipInX animated pt-md-2 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                        <div class="review-one mt-5 mt-md-3">
                            <div class="review-text">
                                <h5 style="font-family: montserrat_regular" class="font-weight-light">"Ideal para principiantes,la verudad que me encantó lo recomiendo"</h5>
                            </div>
                            <div class="review-image">
                                <p class="user_name d-inline" style="font-family: montserrat_bold;">Julian Martinez<i class="ml-3 fa fa-star" style="color:#ffd322;"></i>
                                    <i class="fa fa-star" style="color:#ffd322;"></i>
                                    <i class="fa fa-star" style="color:#ffd322;"></i>
                                    <i class="fa fa-star" style="color:#ffd322;"></i>
                                    <i class="fa fa-star" style="color:#ffd322;"></i></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- As Featured On Section -->
        <!-- Intro Section -->
        <div class="py-5 text-center mt-5 pt-5 bg-black" style="background-color:#23AFFA;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-12">
                        <h1 class="text-white " style="font-family: montserrat_black">Una persona con conocimientos en inglés tiene hasta 5 veces mayor oportunidad laboral</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">


                        <p class="font-weight-light lead mb-4" ><span style="background-color:#f3c910; color:black;font-family: montserrat_bold;" class="p-1">Inglés</span> Hoy en día es el idioma más importante del mercado y con mayor <b>facilidad para aprenderlo.</b>

                        <p class="lead mb-4">A través de este curso aprenderás los verbos más usados, tiempos verbales básicos y mucho más para puedas mantener una conversación fluida. Explicado paso a paso en más de 45 clases paso a paso por nuestro profesor <span style="background-color:black; color:white;" class="p-1 font-w">con más de 15 años de trayectoria</span><br></p>
                        <hr>
                        <p class="lead" style="">Sin requisitos!<br></p>
                        <div class="call-button mt-5">
                            <div class="row justify-content-md-cen">
                                <div class="col-md-5">
                                    <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow-lg text-dark" data-wow-delay="0.2s">Inscribirme</a>
                                </div>
                            </div>
                            <div class="rating-user d-inline"><br>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+3000 estudiantes</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="py-5 bg text-white" style="background-color:#23AFFA">
            <div class="container "  >
                <div class="row mx-auto">
                    <div class="col-lg-5 col-md-6 p-md-4   mx-0 px-0" > <img class="img-fluid d-block rounded shadow  " src="img/ingles-producto2.jpg" width="1500"> </div>
                    <div class="col-md-6 offset-lg-1 d-flex flex-column justify-content-center py-4">
                        <h2 class="my-3 mx-auto mx-md-1 mt-5 mt-md-1" style="font-family: montserrat_bold"> <b>Vas a aprender:</b></h2>
                        <ul class="mx-auto mx-md-1 lead">
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Tiempos verbales del presente</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Verbo TO BE</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Pronombres más usados</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Preposiciones más usadas</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Vocabulario básico para conversar</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> +200 Ejercicios Prácticos</li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5 mb-5 pb-5 mt-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-3">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/certificado.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Certificado</h4>
                                <p class="mb-0">Obtén tu Certificación Oficial para adjuntar a tu CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/soporte.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Comunidad online</h4>
                                <p class="mb-0">Contamos con un espacio para que puedas practicar tu inglés con otros alumnos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/acceso.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Acceso de por vida</h4>
                                <p class="mb-0">Te queda para siempre. Házlo a tu ritmo y sin horarios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5 bg-dark text-white"   id="ch">
            <div class="container my-3">
                <div class="row">
                    <div class="text-center mx-auto col-md-12">
                        <h1  style="font-family: montserrat_bold">Lo que dicen nuestros alumnos/as</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3"><i></i>"Excelente curso de Inglés"<i></i> </p>
                        <p class="mb-1"> <b>Lara Barro</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3">"Muy bueno el curso solamente tuve experiencia en la secundaria y este curso me ayudó a impulsarme definitivamente en Inglés"&nbsp;&nbsp;</p>
                        <p class="mb-1"> <b>Martin Abalo</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3">"Muy práctico y hay bastantes ejercicios para resolver" </p>
                        <p class="mb-1"> <b>Anibal Caceres</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3">"Explica bien y bastante práctico"</p>
                        <p class="mb-1"> <b>Antonella Napoli</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3">"La verdad que por el precio es re completo, recomiendo!"</p>
                        <p class="mb-1"> <b>Barby Morichetti</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3"> "Recomiendo y voy a hacer el próximo nivel"</p>
                        <p class="mb-1"><b>Emiliano Furlan</b></p>
                        <div class="rating-user d-inline">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reviews Section -->
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p> </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ -->
        <section class="pt-5 pb-5" id="gr">
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="mt-2 mb-1 pb-3 text-dark " style="font-family: montserrat_bold" ><i class="fa fa-question-circle" aria-hidden="true">&nbsp;</i>Preguntas Frecuentes&nbsp;</h2>
                </div>
                <div class="accordion mt-4" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">#1 ¿Por cuánto tiempo lo tengo o lo puedo descargar?</button></h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                            <div class="card-body"> ¡De por vida! Una vez que abones tendrás acceso para siempre, podrás descargar el curso y verlo desde cualquier lugar sin conexión a internet.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, + 45 clases para que hagas a tu ritmo y si decides seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">#3 ¿Dan material práctico?</button></h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Sí! Además de brindarte tareas contamos con una comunidad en facebook donde vas a poder comunicarte con cualquier alumno para practicar</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">#4 ¿Incluye Certificación o Diploma?</button></h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample" style="">
                            <div class="card-body">Una vez termines el curso podrás solicitarnos gratis el Certificado de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar inglés desde cero o refuerzes tus conocimientos!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Puedes consultar cualquier duda por e-mail</div>
                        </div>
                    </div>
                    <div class="call-button mt-5">
                        <div class="row justify-content-md-center">
                            <div class="col-md-3">
                                <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow text-dark" data-wow-delay="0.2s">Acceder al curso</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <!--TEMARIO -->
        <div class=" index2_services float_left pt-100 pb-100 " id="gr" style="background-color:#d52d7a" >
            <div class="container align-items-center justify-content-center rounded py-5" >
                <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mira todo lo que vas a aprender</h2>						 
                <div class="row " >
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12  mx-auto" >
                        <div id="accordion" role="tablist ">
                            <div class="card">
                                <!-- Card Title -->
                                <div class="card_pagee py-4 shadow "  role="tab" id="headingSix"  >
                                    <h5 class="h5-md text-center text-dark" >
                                        <a data-toggle="collapse" href="#collapseSix" role="button" aria-expanded="true" aria-controls="collapseSix" class="py-4  text-dark">
                                            Clickeame
                                        </a>
                                    </h5>
                                </div>
                                <!-- Card Content -->
                                <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                    <div class="card-body">
                                        <div class=" show ">
                                            <br>
                                            <b>Módulo 1 - Vocabulario (Primeros pasos)</b><br>
                                            <li>Clase 1 – Saludos</li>
                                            <li>Clase 2 – Números</li>
                                            <li>Clase 3 – Family</li>
                                            <li>Clase 4 – Artículo Determinativo e Indeterminativo</li>
                                            <li>Clase 5 – Ejercicios Artículo Determinativo e Indeterminativo</li>
                                            <li>Clase 6 – Reglas Gramáticas Básicas</li>
                                            <li>Clase 7 – Días/Estaciones/Meses</li>
                                            <li>Clase 8 – Verbo TO BE(Presente)</li>
                                            <li>Clase 9 – Ejercicios verbo TO BE (Presente)</li>
                                            <br>
                                            <b>Módulo 2 - Los Pronombres</b><br>		  
                                            <li>Clase 10 – Pronombres Personales</li>
                                            <li>Clase 11 – Ejercicios Pronombres Personales</li>
                                            <li>Clase 12 – Pronombres Demostrativos</li>
                                            <li>Clase 13 – Ejercicios Pronombres Demostrativos</li>
                                            <li>Clase 14 – Pronombres Acusatorios</li>
                                            <li>Clase 15 – Pronombres Interrogativos WH</li>
                                            <li>Clase 16 – Pronombres Posesivos</li>      
                                            <li>Clase 17 – Ejercicios Pronombres Posesivos</li> 
                                            <br>
                                            <b>Módulo 3 - Tiempos verbales del Presente</b><br>
                                            <li>Clase 18 – Presente Simple</li>   
                                            <li>Clase 19 – Ejercicios Presente Simple </li>   
                                            <li>Clase 20 – Ejercicios 2 Presente Simple</li>   
                                            <li>Clase 21 – Presente Continuo</li>   
                                            <li>Clase 22 – Ejercicios Presente Continuo</li>   
                                            <li>Clase 23 – Ejercicios 2 Presente Continuo</li>   
                                            <li>Clase 24 – Casos del ING</li>   
                                            <br>
                                            <b>Módulo 4 - Las Preposiciones</b><br>
                                            <li>Clase 25 – Preposiciones IN/ON/AT</li>   
                                            <li>Clase 26 – Ejercicios Preposiciones IN/ON/AT</li>   
                                            <li>Clase 27 – Preposiciones del lugar</li>   
                                            <li>Clase 28 – Preposiciones del tiempo </li>   
                                            <li>Clase 29 – Preposiciones de dirección</li>   
                                            <li>Clase 30 – Ejerciciones de Preposiciones combinadas</li>   
                                            <br>
                                            <b>Módulo 5 - Gramática y Vocabulario</b><br>
                                            <li>Clase 31 – HAVE AND HAS</li>   
                                            <li>Clase 32 – Verbos de Modo (CAN/MAY/MUST)</li> 
                                            <li>Clase 33 – WHOSE AND WHO'S</li>  
                                            <li>Clase 34 – Horario</li>  
                                            <li>Clase 35 – Clima y Colores</li>  
                                            <li>Clase 36 – Descripción Física</li>  
                                            <li>Clase 37 – Partes del cuerpo</li>  
                                            <li>Clase 38 – Cosas Contables e Incontables</li>  
                                            <li>Clase 39 – Expresar Nacionalidad</li>  
                                            <li>Clase 40 – Freetime</li>  
                                            <li>Clase 41 – Jobs</li>  
                                            <li>Clase 42 – Ordinal Numbers</li>  
                                            <li>Clase 43 – Partes del día y comidas del día</li>  
                                            <li>Clase 44 – Partes de la casa</li>   
                                            <br>
                                            <br>
                                            <a href="/ingles-nivel-dos/" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;"><b>Quieres más conocimientos? Mira el nivel 2 👉 </b></a> 	 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section id="ch">
            <div class="container">
                <div class="section-heading ">
                    <h2 class="mt-2 mb-1 pb-3 text-dark" style="font-family: montserrat_bold"><i class="fa fa-question-circle" aria-hidden="true">&nbsp;</i>Preguntas Frecuentes&nbsp;</h2>
                </div>
                <div class="accordion mt-4" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0" style=""><button class="btn btn-link text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">#1 ¿Por cuánto tiempo lo tengo o lo puedo descargar?</button></h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                            <div class="card-body">¡De por vida! Una vez que abones tendrás acceso para siempre, podrás descargar el curso y verlo desde cualquier lugar sin conexión a internet.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header " id="headingTwo">
                            <h5 class="mb-0 " style=""><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                            <div class="card-body"> Lo que vos decidas, + 45 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">#3 ¿Dan material práctico?</button></h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Sí! Además de brindarte tareas contamos con una comunidad en facebook donde podrás comunicarte con cualquier alumno para practicar</div>
                        </div>
                    </div>
                    <div class="card text-left">
                        <div class="card-header " id="headingFour">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">#4 ¿Incluye Certificado o Diploma?</button></h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample" style="">
                            <div class="card-body">Una vez termines el curso podrás solicitarnos gratis el Certificado oficial de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar inglés desde cero o refuerzes tus conocimientos!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Sí, damos soporte 24/7. Puedes consultar cualquier duda por e-mail</div>
                        </div>
                    </div>
                </div>
                <!--TEMARIO -->
                <div class=" index2_services float_left pt-100 pb-100 " style="background-color:#d52d7a" >
                    <div class="container align-items-center justify-content-center rounded py-5" >
                        <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mira todo lo que vas a aprender</h2>						 
                        <div class="row " >
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12  mx-auto" >
                                <div id="accordion" role="tablist ">
                                    <div class="card">
                                        <!-- Card Title -->
                                        <div class="card_pagee py-4 shadow "  role="tab" id="headingSix"  >
                                            <h5 class="h5-md text-center text-dark" >
                                                <a data-toggle="collapse" href="#collapseSix" role="button" aria-expanded="true" aria-controls="collapseSix" class="py-4  text-dark">
                                                    Clickeame
                                                </a>
                                            </h5>
                                        </div>
                                        <!-- Card Content -->
                                        <div id="collapseSix" id="ch" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <div class=" show ">
                                                    <br>
                                                    <b>Módulo 1 - Vocabulario (Primeros pasos)</b><br>
                                                    <li>Clase 1 – Saludos</li>
                                                    <li>Clase 2 – Números</li>
                                                    <li>Clase 3 – Family</li>
                                                    <li>Clase 4 – Artículo Determinativo e Indeterminativo</li>
                                                    <li>Clase 5 – Ejercicios Artículo Determinativo e Indeterminativo</li>
                                                    <li>Clase 6 – Reglas Gramáticas Básicas</li>
                                                    <li>Clase 7 – Días/Estaciones/Meses</li>
                                                    <li>Clase 8 – Verbo TO BE(Presente)</li>
                                                    <li>Clase 9 – Ejercicios verbo TO BE (Presente)</li>
                                                    <br>
                                                    <b>Módulo 2 - Los Pronombres</b><br>		  
                                                    <li>Clase 10 – Pronombres Personales</li>
                                                    <li>Clase 11 – Ejercicios Pronombres Personales</li>
                                                    <li>Clase 12 – Pronombres Demostrativos</li>
                                                    <li>Clase 13 – Ejercicios Pronombres Demostrativos</li>
                                                    <li>Clase 14 – Pronombres Acusatorios</li>
                                                    <li>Clase 15 – Pronombres Interrogativos WH</li>
                                                    <li>Clase 16 – Pronombres Posesivos</li>      
                                                    <li>Clase 17 – Ejercicios Pronombres Posesivos</li> 
                                                    <br>
                                                    <b>Módulo 3 - Tiempos verbales del Presente</b><br>
                                                    <li>Clase 18 – Presente Simple</li>   
                                                    <li>Clase 19 – Ejercicios Presente Simple </li>   
                                                    <li>Clase 20 – Ejercicios 2 Presente Simple</li>   
                                                    <li>Clase 21 – Presente Continuo</li>   
                                                    <li>Clase 22 – Ejercicios Presente Continuo</li>   
                                                    <li>Clase 23 – Ejercicios 2 Presente Continuo</li>   
                                                    <li>Clase 24 – Casos del ING</li>   
                                                    <br>
                                                    <b>Módulo 4 - Las Preposiciones</b><br>
                                                    <li>Clase 25 – Preposiciones IN/ON/AT</li>   
                                                    <li>Clase 26 – Ejercicios Preposiciones IN/ON/AT</li>   
                                                    <li>Clase 27 – Preposiciones del lugar</li>   
                                                    <li>Clase 28 – Preposiciones del tiempo </li>   
                                                    <li>Clase 29 – Preposiciones de dirección</li>   
                                                    <li>Clase 30 – Ejerciciones de Preposiciones combinadas</li>   
                                                    <br>
                                                    <b>Módulo 5 - Gramática y Vocabulario</b><br>
                                                    <li>Clase 31 – HAVE AND HAS</li>   
                                                    <li>Clase 32 – Verbos de Modo (CAN/MAY/MUST)</li> 
                                                    <li>Clase 33 – WHOSE AND WHO'S</li>  
                                                    <li>Clase 34 – Horario</li>  
                                                    <li>Clase 35 – Clima y Colores</li>  
                                                    <li>Clase 36 – Descripción Física</li>  
                                                    <li>Clase 37 – Partes del cuerpo</li>  
                                                    <li>Clase 38 – Cosas Contables e Incontables</li>  
                                                    <li>Clase 39 – Expresar Nacionalidad</li>  
                                                    <li>Clase 40 – Freetime</li>  
                                                    <li>Clase 41 – Jobs</li>  
                                                    <li>Clase 42 – Ordinal Numbers</li>  
                                                    <li>Clase 43 – Partes del día y comidas del día</li>  
                                                    <li>Clase 44 – Partes de la casa</li>    
                                                    <br>
                                                    <br>
                                                    <a href="/ingles-nivel-dos/" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;"><b>Querés más conocimientos? Mira el nivel 2 👉 </b></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	


                <div class="call-button mt-5">
                    <div class="row justify-content-md-center">
                        <div class="col-md-3">
                            <a href="checkout.php" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;">Lo quiero </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bottom Product -->
        <section class="bottom-product bg-light" style="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="">
                            <img src="img/producto1.jpg" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Sumá Inglés a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Pago por única vez en pesos de tu país. (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_bold;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>       </div>
                        <div class="call-button mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top  wow flipInX animated text-dark shadow" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s;">Inscribirme</a>
                                </div>
                                <div class="col-md-6 payments ">
                                    <img src="img/seguridad.png" class="img-fluid wow flipInX animated px-5 px-md-0 mt-md-0 mt-3 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MOBILE ALERT | Direcciona a la seccion de compra y tiene el temporizador de la oferta-->
        <div class="container-fluid d-lg-none m-0 p-0" id="mobile-alert">
            <div class="row m-0 p-0">
                <div class="col-12 ">
                    <div class="row">
                        <div class="col-auto mt-2 mx-auto text-center  small-timer">
                           <b>La oferta termina en </b><br><span id="temporizadorMobile"></span>
                        </div>
                    </div>      
                </div>
                <div class="col-9 col-sm-6 mx-auto py-1 m-0 p-0">
                    <div class="row">
                        <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="precio-antes-p m-0">Antes <span class="tachado"><span id="precio-anterior-alerta"><?= $precioCursoOficial ?></span></span></div>
                        </div>
                        <div class="col-6 py-2 text-center">
                            <div class="precio m-0"><?= $simbolo ?><span id="precio-nuevo-alerta"><?= $value ?></span> <?= $monedaOficial ?></div>
                        </div>
                    </div>
                    <a href="checkout.php" class="btn btn-buy animate-hover py-2 mb-2 text-center ps-4">
                        ¡Inscribirme Ahora! <i class="fas fa-chevron-right me-3 ps-2 animate-right-3"></i>
                    </a>  
                </div>
            </div>
        </div>
        <!-- FIN MOBILE ALERT | Direcciona a la seccion de compra-->

        <?php include('../a-pages/footer.php') ?>

        <script>
            fbq('track', 'ViewContent');
        </script>
        <script>
            fbq('trackCustom', 'visitas ingles');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-VE1K0ZKEG6');
        </script>
        <!-- Script AI de analytics -->
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-196494254-1');
        </script>
    </body>

</html>

<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$dirpage = '../';
$titulo = 'Aprende Ingles desde 0';
$curso = 'italiano_ingles';

require("../includes/Keys.php");
include("../includes/funcionsDB.php");
include("../includes/logicparametros.php");
require ("../includes/Funciones.php");

//echo 'curso = ' . $curso . '<br>';
//echo 'moneda = ' . $moneda . '<br><br><br>';
$productoC1 = getDataProducto($curso, $moneda);
//echo "<pre>";
//print_r($productoC1);
//echo "</pre>";

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
                        <a href="/" target="_blank"><img src="img/logo.jpg" alt="logo" class="img-fluid"> </a>
                    </div>
                    <div class="col-md-3 hdphone">
                        <p> Aprendé a distancia</p>
                    </div>
                    <div class="col-md-3 hdphone">
                        <img src="img/securityjpg.jpg" alt="security" class="img-fluid">
                    </div>
                    <div class="col-md-3 cta-button  col-sm-6 col-6">
                        <a class="hvr-sweep-to-right  text-black" href="checkout.php" style="backgruound-color: #001fff">Lo quiero</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Website Sections -->
        <!-- Top Product Banner -->
        <section class="top-product  bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class=" py-auto">
                            <img src="img/ItalianoIng.png" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" >
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading ">
                            <h3 style="color:black;">Curso online a distancia</h3>
                            <h1 class="mt-4  " style=""><b>APRENDÉ <span style="font-family: montserrat_black ;">ITALIANO e INGLÉS DESDE CERO!</span></b></h1>
                        </div>
                        <div class="feature-list mt-4">
                            <ul class="font-weight-light" style="font-family: montserrat_light ;">
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;"><i class="fas fa-check-circle text-dark"></i> 89 clases paso a paso!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Descargá el curso y miralo sin conexión a internet!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Acceso para siempre al curso</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Ayuda de los profesores online </li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-dark"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-dark"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center bg-success text-white" style="background-color:#FF0000; color:black;font-family: montserrat_regular;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Argentina. Éste precio es final y en Pesos Argentinos</p>
                        </div>
                        <div class="call-button mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top wow flipInX animated shadow text-black" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color:#008cd7; ">Lo quiero</a>
                                </div>
                                <div class="col-md-6 payments">
                                    <img src="img/security.png" class="img-fluid wow flipInX animated pt-md-2 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                        <div class="review-one mt-5 mt-md-3">
                            <div class="review-text">
                                <h5 style="font-family: montserrat_regular" class="font-weight-light">"Excelente pack, recomendado."</h5>
                            </div>
                            <div class="review-image">
                                <p class="user_name d-inline" style="font-family: montserrat_bold;">Sofia Caceres<i class="ml-3 fa fa-star" style="color:#ffd322;"></i>
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
        <div class="py-5 text-center mt-5 pt-5 bg-black " style="background-color:#FF0000;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-12">
                        <h1 class="text-white " style="font-family: montserrat_black">La mejor forma de aprender italiano e inglés a nivel mundial</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">
                        <p class="font-weight-light lead mb-4">Hablado por más de 1.400 millones de personas, el italiano y el inglés, te va a ayudar a navegar las calles de Roma en tu próximo viaje al extranjero. El italiano es la lengua romance arquetípica, y un buen punto de partida para aprender otros idiomas derivados del latín.. </p>
                        <p class="lead mb-4">A través de este curso vas a aprender los verbos más usados, tiempos verbales básicos y mucho más para puedas mantener una conversación fluida. Explicado paso a paso en más de 25 clases paso a paso por nuestro profesor <span style="background-color:black; color:white;" class="p-1 font-w">con más de 15 años de trayectoria</span><br></p>
                        <hr>
                        <p class="lead" style="">Sin requisitos!<br></p>
                        <div class="call-button mt-5">
                            <div class="row justify-content-md-cen">
                                <div class="col-md-5">
                                    <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow-lg  text-white" data-wow-delay="0.2s" style="background-color:#001fff; ">Inscribirme</a>
                                </div>
                            </div>
                            <div class="rating-user d-inline"><br>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+1500 estudiantes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 bg text-white bg-success" style="background-color:#23AFFA">
            <div class="container ">
                <div class="row mx-auto">
                    <div class="col-lg-5 col-md-6 p-md-4   mx-0 px-0"> <img class="img-fluid d-block rounded shadow  " src="img/itaing.png" width="1500"> </div>
                    <div class="col-md-6 offset-lg-1 d-flex flex-column justify-content-center py-4">
                        <h2 class="my-3 mx-auto mx-md-1 mt-5 mt-md-1" style="font-family: montserrat_bold"> <b>Vas a aprender:</b></h2>
                        <ul class="mx-auto mx-md-1 lead">
                            <li><i class="fas fa-check text-body" style="color:#f3c910;"></i> Tiempos verbales del presente</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Verbo Essere</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Pronombres más usados</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Vocabulario básico para conversar</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Tiempos verbales del presente en inglés</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Verbo TO BE</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Pronombres más usados</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Preposiciones más usadas</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Vocabulario básico para conversar</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Superlativos </li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Comparativos</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Hablar en tiempos verbales del futuro</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Hablar en tiempos verbales del pasado</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Lecturas</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Artículos, colores, números y mucho más...</li>
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
                                <p class="mb-0">Obtené tu Certificación Oficial para adjuntar a tu CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/soporte.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Comunidad online</h4>
                                <p class="mb-0">Contamos con espacio para que puedas practicar Italiano con otros alumnos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/acceso.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Acceso de por vida</h4>
                                <p class="mb-0">Te queda para siempre. Hacelo a tu ritmo y sin horarios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 bg-dark text-white" id="ch">
            <div class="container my-3">
                <div class="row">
                    <div class="text-center mx-auto col-md-12">
                        <h1 style="font-family: montserrat_bold">Lo que dicen nuestros alumnos/as</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 p-4 text-center">
                        <div class="review-image text-center mt-3 mb-3">
                        </div>
                        <p class="mb-3"><i></i>"Nunca habia estudiando italiano parece dificil pero no lo es"<i></i> </p>
                        <p class="mb-1"> <b>Ramiro Testa</b></p>
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
                        <p class="mb-3">"El profesor explica muy bien"</p>
                        <p class="mb-1"> <b>Maxi Pintos</b></p>
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
                        <p class="mb-3">"Me gustó el curso en general y la parte de las lecturas" </p>
                        <p class="mb-1"> <b>Martina Brasilosky</b></p>
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
                        <p class="mb-3">"Un saludo al profe, un crack"</p>
                        <p class="mb-1"> <b>Sofi Martinez</b></p>
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
                        <p class="mb-3">"Esperando al próximo nivel para anotarme ya"</p>
                        <p class="mb-1"> <b>Ivan Moricuo</b></p>
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
                        <p class="mb-3"> "Recomiendo para los que empiezan de cero, muy bueno"</p>
                        <p class="mb-1"><b>Emiliano Montreal</b></p>
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
                    <h2 class="mt-2 mb-1 pb-3 text-dark " style="font-family: montserrat_bold"><i class="fa fa-question-circle" aria-hidden="true">&nbsp;</i>Preguntas Frecuentes&nbsp;</h2>
                </div>
                <div class="accordion mt-4" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">#1 ¿Por cuánto tiempo lo tengo o lo puedo descargar?</button></h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                            <div class="card-body"> ¡De por vida! Una vez que abones vas a tener acceso para siempre, vas a poder descargar el curso y verlo desde cualquier lugar sin conexión a internet.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, 89 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
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
                            <div class="card-body">Una vez termines el curso podés solicitarnos gratis el Certificado de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar italiano desde cero o refuerzes tus conocimientos!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podés consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                    <div class="call-button mt-5">
                        <div class="row justify-content-md-center">
                            <div class="col-md-3">
                                <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow bg-danger text-white" data-wow-delay="0.2s">Acceder al curso</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--TEMARIO -->
        <div class="index2_services float_left pt-100 pb-100 " id="gr" style="background-color:#FF0000">
            <div class="container align-items-center justify-content-center rounded py-5">
                <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mirá todo lo que vas a aprender</h2>
                <div class="row ">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12  mx-auto">
                        <div id="accordion" role="tablist ">
                            <div class="card">
                                <!-- Card Title -->
                                <div class="card_pagee py-4 shadow " role="tab" id="headingSix">
                                    <h5 class="h5-md text-center text-dark">
                                        <a data-toggle="collapse" href="#collapseSix" role="button" aria-expanded="true" aria-controls="collapseSix" class="py-4  text-dark"> Clickeame </a>
                                    </h5>
                                </div>
                                <!-- Card Content -->
                                <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                    <div class="card-body">
                                        <div class=" show ">
                                            <br><ul>  <p><b>Italiano Inicial</b></p> 
                                                <li>Clase 1 - Alfabeto</li>
                                                <li>Clase 2 - Pronunciación</li>
                                                <li>Clase 3 - Sonidos Especiales</li>
                                                <li>Clase 4 - Pronombres personales</li>
                                                <li>Clase 5 - Verbo Essere</li>
                                                <li>Clase 6 - Saludos</li>
                                                <li>Clase 7 - Presentarse</li>
                                                <li>Clase 8 - Italia en el mundo</li>
                                                <li>Clase 9 - Sustantivos: femenino, masculino, singular y plural</li>
                                                <li>Clase 10 - Sustantivos: Excepciones</li>
                                                <li>Clase 11 - Artículos definidos</li>
                                                <li>Clase 12 - Artículos definidos: ejercicios</li>
                                                <li>Clase 13 - Artículos indefinidos</li>
                                                <li>Clase 14 - La familia</li>
                                                <li>Clase 15 - Números</li>
                                                <li>Clase 16 - El horario - Preposiciones de tiempo</li>
                                                <li>Clase 17 - El calendario </li>
                                                <li>Clase 18 - Presente simple y adverbios</li>
                                                <li>Clase 19 - Verbo Avere</li>
                                                <li>Clase 20 - Verbos irregulares</li>
                                                <li>Clase 21 - El clima - las estaciones del año - verbo fare</li>
                                                <li>Clase 22 - Adjetivos Calificativos</li>
                                                <li>Clase 23 - Lectura 1</li>
                                                <li>Clase 24 - Comparativo y superlativo</li>
                                                <li>Clase 25 - Los colores</li>
                                                <li>Clase 26 - Preposiciones</li>
                                                <li>Clase 27 - Preposiciones articuladas</li>
                                                <li>Clase 28 - Pasatiempos / acuerdo y desacuerdo</li>
                                                <li>Clase 29 - Lectura 2</li>
                                                <li>Clase 30 - Pronombres: Complemento directo e indirecto</li>
                                                <li>Clase 31 - El cuerpo humano</li>
                                                <li>Clase 32 - La casa</li>
                                                <li>Clase 33 - Las comidas y el restaurante</li>
                                                <li>Clase 34 - Lettura 3</li>
                                                <li>Clase 35 - Presente Continuo: Stare + Gerundio</li>
                                                <li>Clase 36 - La ciudad</li>
                                                <li>Clase 37 - Viajes y vacaciones</li>
                                                <li>Clase 38 - Medios de comunicación</li>
                                                <li>Clase 39 - Redes sociales</li>
                                                <li>Clase 40 - Adjetivos y pronombres posesivos</li>
                                                <li>Clase 41 - Passato Prossimo</li>
                                                <li>Clase 42 - Lectura 4</li>
                                                <li>Clase 43 - Essercizi</li>
                                                <br>
                                            </ul>
                                            <ul>
                                                <br>
                                                <p><b>Inglés nivel Inicial</b></p>

                                                <li>Clase 1 - Pronombres Personales</li>
                                                <li>Clase 2 - Verbo Essere</li>
                                                <li>Clase 3 - Colores</li>
                                                <li>Clase 4 – Números</li>
                                                <li>Clase 5 – Días de la semana</li>
                                                <li>Clase 6 – Meses Del Año</li>
                                                <li>Clase 7 – Estaciones del año</li>
                                                <li>Clase 8 – El clima</li>
                                                <li>Clase 9 - Verbo Tener</li>
                                                <li>Clase 9 - Verbo Tener</li>
                                                <li>Clase 10 - Articulo determinativo singular</li>
                                                <li>Clase 11 - L´ Alfabeto</li>
                                                <li>Clase 12 - Saludos Primera Parte</li>
                                                <li>Clase 12.2 Saludos segunda parte</li>
                                                <li>Clase 12.3 Saludos tercera parte</li>
                                                <li>Clase 12.4 Saludos cuarta parte corregido</li>
                                                <li>Clase 13 - Artículos Determinativos plurales</li>
                                                <li>Clase 14 - Articulo Determinativo Femenino</li>
                                                <li>Clase 15 - Articulo indeterminativo singular</li>
                                                <li>Clase 16 - Articulo indeterminativo singular femenino</li>
                                                <li>Clase 17 - La Familia</li>
                                                <li>Clase 18 - Animales</li>
                                                <li>Clase 19 - Partes de la casa</li>
                                                <li>Clase 20 - Posesivo masculino</li>
                                                <li>Clase 21 - Ejemplos Posesivo masculino</li>
                                                <li>Clase 22 - Ejemplos Posesivo femenino</li>
                                                <li>Clase 23 - Partes del cuerpo humano</li>
                                                <li>Clase 24 - Presente indicativo</li>
                                                <li>Clase 25 - Tercera conjugación Presente indicativo IRE</li>
                                                <li>Clase 26 - Domande - Preguntas</li>
                                                <li>Clase 27 - Preguntas personas</li>
                                                <li>Clase 28 - Primera Lectura</li>
                                                <li>Clase 29 - Segunda Lectura</li>
                                                <br>
                                            </ul>
                                            <ul>
                                                <br>
                                                <li><b>Inglés nivel Intermedio</b></li>
                                                <li>Clase 1 - Simple past</li>
                                                <li>Clase 2 - Past Continuos</li>
                                                <li>Clase 3 - Past Perfect</li>
                                                <li>Clase 4 – Linea de tiempo</li>
                                                <li>Clase 5 – Modal verbs in past </li>
                                                <li>Clase 6 – Pronunciación E y ED</li>
                                                <li>Clase 7 – Did VS have </li>
                                                <li>Clase 8 – Usos del HAVE</li>
                                                <li>Clase 9 - Present Perfec</li>
                                                <li>Clase 10 - Simple Future</li>
                                                <li>Clase 11 - Near Future going to</li>
                                                <li>Clase 11 - L´ Alfabeto</li>
                                                <li>Clase 12 - Saludos Primera Parte</li>
                                                <li>Clase 12 - Excepciones de futuro</li>
                                                <li>Clase 13 - Prepositions from scice to</li>
                                                <li>Clase 14 - Situations</li>
                                                <li>Clase 15 - Directions </li>
                                                <li>Clase 16 - Comparatives and superlatives</li>

                                                <br>
                                            </ul>
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
                            <div class="card-body">¡De por vida! Una vez que abones vas a tener acceso para siempre, vas a poder descargar el curso y verlo desde cualquier lugar sin conexión a internet.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header " id="headingTwo">
                            <h5 class="mb-0 " style=""><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                            <div class="card-body"> Lo que vos decidas, + 25 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios. </div>
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
                    <div class="card text-left">
                        <div class="card-header " id="headingFour">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">#4 ¿Incluye Certificado o Diploma?</button></h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample" style="">
                            <div class="card-body">Una vez termines el curso podés solicitarnos gratis el Certificado oficial de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar italiano desde cero o refuerzes tus conocimientos!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podés consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                </div>
                <!--TEMARIO -->
                <div class=" index2_services float_left pt-100 pb-100 " style="background-color:#d52d7a">
                    <div class="container align-items-center justify-content-center rounded py-5 bg-success">
                        <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mirá todo lo que vas a aprender</h2>
                        <div class="row ">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12  mx-auto">
                                <div id="accordion" role="tablist ">
                                    <div class="card">
                                        <!-- Card Title -->
                                        <div class="card_pagee py-4 shadow " role="tab" id="headingSix">
                                            <h5 class="h5-md text-center text-dark">
                                                <a data-toggle="collapse" href="#collapseSix" role="button" aria-expanded="true" aria-controls="collapseSix" class="py-4  text-dark"> Clickeame </a>
                                            </h5>
                                        </div>
                                        <!-- Card Content -->
                                        <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <div class=" show ">
                                                    <br><ul>  <p><b>Italiano Inicial</b></p> 
                                                        <li>Clase 1 - Alfabeto</li>
                                                        <li>Clase 2 - Pronunciación</li>
                                                        <li>Clase 3 - Sonidos Especiales</li>
                                                        <li>Clase 4 - Pronombres personales</li>
                                                        <li>Clase 5 - Verbo Essere</li>
                                                        <li>Clase 6 - Saludos</li>
                                                        <li>Clase 7 - Presentarse</li>
                                                        <li>Clase 8 - Italia en el mundo</li>
                                                        <li>Clase 9 - Sustantivos: femenino, masculino, singular y plural</li>
                                                        <li>Clase 10 - Sustantivos: Excepciones</li>
                                                        <li>Clase 11 - Artículos definidos</li>
                                                        <li>Clase 12 - Artículos definidos: ejercicios</li>
                                                        <li>Clase 13 - Artículos indefinidos</li>
                                                        <li>Clase 14 - La familia</li>
                                                        <li>Clase 15 - Números</li>
                                                        <li>Clase 16 - El horario - Preposiciones de tiempo</li>
                                                        <li>Clase 17 - El calendario </li>
                                                        <li>Clase 18 - Presente simple y adverbios</li>
                                                        <li>Clase 19 - Verbo Avere</li>
                                                        <li>Clase 20 - Verbos irregulares</li>
                                                        <li>Clase 21 - El clima - las estaciones del año - verbo fare</li>
                                                        <li>Clase 22 - Adjetivos Calificativos</li>
                                                        <li>Clase 23 - Lectura 1</li>
                                                        <li>Clase 24 - Comparativo y superlativo</li>
                                                        <li>Clase 25 - Los colores</li>
                                                        <li>Clase 26 - Preposiciones</li>
                                                        <li>Clase 27 - Preposiciones articuladas</li>
                                                        <li>Clase 28 - Pasatiempos / acuerdo y desacuerdo</li>
                                                        <li>Clase 29 - Lectura 2</li>
                                                        <li>Clase 30 - Pronombres: Complemento directo e indirecto</li>
                                                        <li>Clase 31 - El cuerpo humano</li>
                                                        <li>Clase 32 - La casa</li>
                                                        <li>Clase 33 - Las comidas y el restaurante</li>
                                                        <li>Clase 34 - Lettura 3</li>
                                                        <li>Clase 35 - Presente Continuo: Stare + Gerundio</li>
                                                        <li>Clase 36 - La ciudad</li>
                                                        <li>Clase 37 - Viajes y vacaciones</li>
                                                        <li>Clase 38 - Medios de comunicación</li>
                                                        <li>Clase 39 - Redes sociales</li>
                                                        <li>Clase 40 - Adjetivos y pronombres posesivos</li>
                                                        <li>Clase 41 - Passato Prossimo</li>
                                                        <li>Clase 42 - Lectura 4</li>
                                                        <li>Clase 43 - Essercizi</li>
                                                        <br>
                                                    </ul>
                                                    <ul>
                                                        <br>
                                                        <p><b>Inglés nivel Inicial</b></p>

                                                        <li>Clase 1 - Pronombres Personales</li>
                                                        <li>Clase 2 - Verbo Essere</li>
                                                        <li>Clase 3 - Colores</li>
                                                        <li>Clase 4 – Números</li>
                                                        <li>Clase 5 – Días de la semana</li>
                                                        <li>Clase 6 – Meses Del Año</li>
                                                        <li>Clase 7 – Estaciones del año</li>
                                                        <li>Clase 8 – El clima</li>
                                                        <li>Clase 9 - Verbo Tener</li>
                                                        <li>Clase 9 - Verbo Tener</li>
                                                        <li>Clase 10 - Articulo determinativo singular</li>
                                                        <li>Clase 11 - L´ Alfabeto</li>
                                                        <li>Clase 12 - Saludos Primera Parte</li>
                                                        <li>Clase 12.2 Saludos segunda parte</li>
                                                        <li>Clase 12.3 Saludos tercera parte</li>
                                                        <li>Clase 12.4 Saludos cuarta parte corregido</li>
                                                        <li>Clase 13 - Artículos Determinativos plurales</li>
                                                        <li>Clase 14 - Articulo Determinativo Femenino</li>
                                                        <li>Clase 15 - Articulo indeterminativo singular</li>
                                                        <li>Clase 16 - Articulo indeterminativo singular femenino</li>
                                                        <li>Clase 17 - La Familia</li>
                                                        <li>Clase 18 - Animales</li>
                                                        <li>Clase 19 - Partes de la casa</li>
                                                        <li>Clase 20 - Posesivo masculino</li>
                                                        <li>Clase 21 - Ejemplos Posesivo masculino</li>
                                                        <li>Clase 22 - Ejemplos Posesivo femenino</li>
                                                        <li>Clase 23 - Partes del cuerpo humano</li>
                                                        <li>Clase 24 - Presente indicativo</li>
                                                        <li>Clase 25 - Tercera conjugación Presente indicativo IRE</li>
                                                        <li>Clase 26 - Domande - Preguntas</li>
                                                        <li>Clase 27 - Preguntas personas</li>
                                                        <li>Clase 28 - Primera Lectura</li>
                                                        <li>Clase 29 - Segunda Lectura</li>
                                                        <br>
                                                    </ul>
                                                    <ul>
                                                        <br>
                                                        <li><b>Inglés nivel Intermedio</b></li>
                                                        <li>Clase 1 - Simple past</li>
                                                        <li>Clase 2 - Past Continuos</li>
                                                        <li>Clase 3 - Past Perfect</li>
                                                        <li>Clase 4 – Linea de tiempo</li>
                                                        <li>Clase 5 – Modal verbs in past </li>
                                                        <li>Clase 6 – Pronunciación E y ED</li>
                                                        <li>Clase 7 – Did VS have </li>
                                                        <li>Clase 8 – Usos del HAVE</li>
                                                        <li>Clase 9 - Present Perfec</li>
                                                        <li>Clase 10 - Simple Future</li>
                                                        <li>Clase 11 - Near Future going to</li>
                                                        <li>Clase 11 - L´ Alfabeto</li>
                                                        <li>Clase 12 - Saludos Primera Parte</li>
                                                        <li>Clase 12 - Excepciones de futuro</li>
                                                        <li>Clase 13 - Prepositions from scice to</li>
                                                        <li>Clase 14 - Situations</li>
                                                        <li>Clase 15 - Directions </li>
                                                        <li>Clase 16 - Comparatives and superlatives</li>
                                                        <br>
                                                    </ul>
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
                            <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX animated bg-success text-white" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;">Lo quiero </a>
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
                            <img src="img/ItalianoIng.png" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Sumá Italiano e Inglés a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Pago por única vez en Pesos Argentinos (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center bg-danger text-white" style="background-color:#f3c910; color:black;font-family: montserrat_bold;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>
                        </div>
                        <div class="call-button mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top wow flipInX animated shadow text-white" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; background-color:#001fff">Inscribirme</a>
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

        <?php include('../a-pages/footer.php') ?>

        <script>
            fbq('track', 'ViewContent');
        </script>
        <script>
            fbq('trackCustom', 'visitas italiano');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>

        <!-- FEDE PIXEL FB ADS PREVENTIVO 20-10-2023 -->
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
        <script>
            !function (f, b, e, v, n, t, s)
            {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '851421198669354');
            fbq('init', '177917573796998');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=851421198669354&ev=PageView&noscript=1"
                       /></noscript>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=177917573796998&ev=PageView&noscript=1"
                       /></noscript>			   

        <!-- End Facebook Pixel Code --> 
    </body>
</html>
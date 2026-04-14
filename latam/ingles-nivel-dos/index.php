<?php
if(isset($_GET['test'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$dirpage = '../';
$titulo = 'Aprende Ingles desde 0';
$curso = 'ingles_dos';

require("../includes/Keys.php");
include("../includes/funcionsDB.php");
include("../includes/logicparametros.php");
require ("../includes/Funciones.php");

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
        <header class="bg-dark " style="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <a href="./" target="_blank"><img src="img/logo2.png" alt="logo" class="img-fluid"> </a>
                    </div>
                    <div class="col-md-3 hdphone">
                        <p> </p>
                    </div>
                    <div class="col-md-3 hdphone">
                    </div>
                    <div class="col-md-3 cta-button  col-sm-6 col-6 text-dark">
                        <a class="hvr-sweep-to-right text-white" href="checkout.php">COMPRAR EL CURSO</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Website Sections -->
        <!-- Top Product Banner -->
        <section class="top-product  bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-5" style="">
                        <div class=" py-auto">
                            <img src="img/producto2.jpg" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" alt="curso de power bi">
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
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;" ><i class="fas fa-check-circle text-dark"></i> + 35 clases paso a paso!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Descarga el curso y míralo sin conexión a internet</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Acceso para siempre al curso</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Ayuda de los profesores online</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-dark"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-dark"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_regular;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Latina. Éste precio es final y moneda local.</p>

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
                                <h5 style="font-family: montserrat_regular" class="font-weight-light">"Excelente curso! lo recomiendo 100%"</h5>
                            </div>
                            <div class="review-image">
                                <p class="user_name d-inline" style="font-family: montserrat_bold;">Franco Basso<i class="ml-3 fa fa-star" style="color:#ffd322;"></i>
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
                        <h1 class="text-white " style="font-family: montserrat_black">Una persona con conocimientos en inglés tiene hasta x5 veces mayor oportunidad laboral</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">


                        <p class="font-weight-light lead mb-4" ><span style="background-color:#f3c910; color:black;font-family: montserrat_bold;" class="p-1">Inglés</span> Hoy en día es el idioma más importante del mercado y con mayor <b>facilidad para aprenderlo.</b>

                        <p class="lead mb-4">A través de este curso aprenderás los verbos más usados, tiempos del pasado básicos y tiempos del futuro básicos y mucho más para puedas mantener una conversación fluida. Explicado paso a paso en más de 35 clases por nuestro profesor <span style="background-color:black; color:white;" class="p-1 font-w">con más de 15 años de trayectoria</span><br></p>
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
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+2000 estudiantes</p>
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
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Hablar en tiempos verbales del pasado</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Hablar en tiempos verbales del futuro</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Superlativos </li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Comparativos</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Muchos ejercios prácticos</li>
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
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Certificado Oficial</h4>
                                <p class="mb-0">Obtén tu Certificado Oficial para adjuntar a tu CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/soporte.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Comunidad online</h4>
                                <p class="mb-0">Contamos con un espacio para que puedas practicar tu ingles con otros alumnos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="img/acceso.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Descargá el curso</h4>
                                <p class="mb-0">Podrás ver el curso sin conexión a internet desde cualquier parte. Te queda para siempre. Házlo a tu ritmo y sin horarios.</p>
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
                        <p class="mb-3"><i>"</i>Muy detallado con ejemplos claros. Soy nuevo aprendiendo inglés y me resulta muy fácil<i>"</i> </p>
                        <p class="mb-1"> <b>Maximiliano Rodriguez</b></p>
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
                        <p class="mb-3">"Excelente curso de Inglés. Tenia algo de experiencia en inglés y me ayudo a asentar algunas bases. Lo recomiendo totalmente para nuevos estudiantes"&nbsp;&nbsp;</p>
                        <p class="mb-1"> <b>Juan Guerra</b></p>
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
                        <p class="mb-3">"Está muy por encima de lo que esperaba." </p>
                        <p class="mb-1"> <b>Natalia Testa</b></p>
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
                        <p class="mb-3">"Curso práctico y amigable. Recomiendo ampliamente"</p>
                        <p class="mb-1"> <b>Victoria Rial</b></p>
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
                        <p class="mb-3">"Da muy buenas bases para seguir incursionando en el idioma. Espero el próximo curso"</p>
                        <p class="mb-1"> <b>Federico Romero</b></p>
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
                        <p class="mb-3"> "Empecé sin concomientos y ya estoy practicando con alumnos del grupo. Los videos son muy claros y la atención que me dieron con mis dudas fué rápida"</p>
                        <p class="mb-1"><b>Julia Armani</b></p>
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
                            <div class="card-body"> Si, puedes descargarlo y te queda ¡De por vida! Una vez que abones tendrás acceso para siempre.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, + 35 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
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
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar inglés desde cero!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podrás consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                    <!--TEMARIO -->
                    <div class=" index2_services float_left pt-100 pb-100 " style="background-color:#d52d7a" >
                        <div class="container align-items-center justify-content-center rounded py-5" >
                            <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mirá todo lo que vas a aprender</h2>						 
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
                                            <div id="collapseSix" id="gr" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <div class=" show ">
                                                        <br>
                                                        <b>Módulo 1 - Las Preposiciones</b><br>
                                                        <li>Clase 1 – Preposiciones IN/ON/AT</li>   
                                                        <li>Clase 2 – Ejercicios Preposiciones IN/ON/AT</li>   
                                                        <li>Clase 3 – Preposiciones del lugar</li>   
                                                        <li>Clase 4 – Preposiciones del tiempo </li>   
                                                        <li>Clase 5 – Preposiciones de dirección</li>   
                                                        <li>Clase 6 – Ejerciciones de Preposiciones combinadas</li>  
                                                        <br>
                                                        <b>Módulo 2 - Gramática</b><br>		  
                                                        <li>Clase 7 - Usos del HAVE</li>
                                                        <li>Clase 8 – Comparativo y Superlativo</li>
                                                        <li>Clase 9 – Ejercicios Comparativos y Superlativos</li>
                                                        <li>Clase 10 – Preposiciones FROM, SINCE, TO</li>
                                                        <li>Clase 11 – Directions</li>
                                                        <li>Clase 12 – Situations</li>
                                                        <br>
                                                        <b>Módulo 3 - Tiempo Pasado</b><br>
                                                        <li>Clase 13 – Teoría Simple Past</li>  
                                                        <li>Clase 14 – Simple Past</li>   
                                                        <li>Clase 15 – Lista de Verbos Irregulares</li> 
                                                        <li>Clase 16 – Ejercicios Simple Past </li>   
                                                        <li>Clase 17 – Teoría Past Continuos</li>  
                                                        <li>Clase 18 – Past Continuos</li>   
                                                        <li>Clase 19 – Ejercicios Past Continuos</li>   
                                                        <li>Clase 20 – Teoría Present Perfect</li> 
                                                        <li>Clase 21 – Present Perfect</li>   
                                                        <li>Clase 22 – Ejercicios Present Perfect</li>  
                                                        <li>Clase 23 – Teoría Past Perfect</li>   
                                                        <li>Clase 24 – Past Perfect</li>   
                                                        <li>Clase 25 – Ejercicios Past Perfect</li>   
                                                        <li>Clase 26 – Línea de tiempos verbales</li>   
                                                        <li>Clase 27 – Modal VERBS IN PAST</li>   
                                                        <li>Clase 28 – Pronunciación E y ED</li>   
                                                        <li>Clase 29 – DID vs HAVE</li>   
                                                        <br>
                                                        <b>Módulo 4 - Tiempo Futuro</b><br>
                                                        <li>Clase 30 – Teoría Near Future</li> 
                                                        <li>Clase 31 – Near Future (GOING TO)</li>   
                                                        <li>Clase 32 – Teoría Simple Future</li> 
                                                        <li>Clase 33 – Simple Future</li>   
                                                        <li>Clase 34 – Excepciones del futuro</li>   
                                                        <li>Clase 35 – Ejercicios Combinados del futuro</li> 
                                                        <br>
                                                        <br>
                                                        <a href="/ingles-nivel-uno/" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;"><b>Te faltan conocimientos básicos? Mira el nivel 1 👉 </b></a>	 
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
                                <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow text-dark" data-wow-delay="0.2s">Acceder al curso</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
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
                            <div class="card-body"> Si, podrás descargarlo y te queda ¡De por vida! Una vez que abones tendrás acceso para siempre</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header " id="headingTwo">
                            <h5 class="mb-0 " style=""><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, + 35 clases para que hagas a tu ritmo y si decides seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
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
                            <div class="card-body">Una vez termines el curso podrás solicitarnos gratis el Certificado de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar inglés desde cero!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#6 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podrás consultar cualquier duda en nuestro e-mail</div>
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
                                                        <b>Módulo 1 - Las Preposiciones</b><br>
                                                        <li>Clase 1 – Preposiciones IN/ON/AT</li>   
                                                        <li>Clase 2 – Ejercicios Preposiciones IN/ON/AT</li>   
                                                        <li>Clase 3 – Preposiciones del lugar</li>   
                                                        <li>Clase 4 – Preposiciones del tiempo </li>   
                                                        <li>Clase 5 – Preposiciones de dirección</li>   
                                                        <li>Clase 6 – Ejerciciones de Preposiciones combinadas</li>  
                                                        <br>
                                                        <b>Módulo 2 - Gramática</b><br>		  
                                                        <li>Clase 7 - Usos del HAVE</li>
                                                        <li>Clase 8 – Comparativo y Superlativo</li>
                                                        <li>Clase 9 – Ejercicios Comparativos y Superlativos</li>
                                                        <li>Clase 10 – Preposiciones FROM, SINCE, TO</li>
                                                        <li>Clase 11 – Directions</li>
                                                        <li>Clase 12 – Situations</li>
                                                        <br>
                                                        <b>Módulo 3 - Tiempo Pasado</b><br>
                                                        <li>Clase 13 – Teoría Simple Past</li>  
                                                        <li>Clase 14 – Simple Past</li>   
                                                        <li>Clase 15 – Lista de Verbos Irregulares</li> 
                                                        <li>Clase 16 – Ejercicios Simple Past </li>   
                                                        <li>Clase 17 – Teoría Past Continuos</li>  
                                                        <li>Clase 18 – Past Continuos</li>   
                                                        <li>Clase 19 – Ejercicios Past Continuos</li>   
                                                        <li>Clase 20 – Teoría Present Perfect</li> 
                                                        <li>Clase 21 – Present Perfect</li>   
                                                        <li>Clase 22 – Ejercicios Present Perfect</li>  
                                                        <li>Clase 23 – Teoría Past Perfect</li>   
                                                        <li>Clase 24 – Past Perfect</li>   
                                                        <li>Clase 25 – Ejercicios Past Perfect</li>   
                                                        <li>Clase 26 – Línea de tiempos verbales</li>   
                                                        <li>Clase 27 – Modal VERBS IN PAST</li>   
                                                        <li>Clase 28 – Pronunciación E y ED</li>   
                                                        <li>Clase 29 – DID vs HAVE</li>   
                                                        <br>
                                                        <b>Módulo 4 - Tiempo Futuro</b><br>
                                                        <li>Clase 30 – Teoría Near Future</li> 
                                                        <li>Clase 31 – Near Future (GOING TO)</li>   
                                                        <li>Clase 32 – Teoría Simple Future</li> 
                                                        <li>Clase 33 – Simple Future</li>   
                                                        <li>Clase 34 – Excepciones del futuro</li>   
                                                        <li>Clase 35 – Ejercicios Combinados del futuro</li> 
                                                        <br>
                                                        <br>
                                                        <a href="/ingles-nivel-uno/" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;"><b>Te faltan conocimientos básicos? Mira el nivel 1 👉 </b></a>	  	 
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
                            <img src="img/producto2.jpg" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Suma Inglés a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Pago por única vez en mononeda local (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
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

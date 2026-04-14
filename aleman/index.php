<?php
$dirpage = '../';
$idcurso = 'aleman';

include("../a-includes/funcionsDB.php");
include("../a-includes/logicparametros.php");
$curso = getCursoDetalle($idcurso);

//PRECIO_UNITARIO
 
$value = $curso['PRECIO_UNITARIO'];
$precioCursoOficial = '$' . intval(($value / $curso['PORCENTAJE_DES']) * 100) . ' ARS';
$precioCurso = '$' . $value . ' ARS';

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $curso['TITULO']; ?></title>
        <?php include('../a-pages/headerTM.php') ?>
    </head>
    <body style="font-family: montserrat_regular;">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W3NBJXZ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        <?php include('../a-pages/timer.php') ?>
        
        <header class="bg-dark " style="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <a href="./" target="_blank"><img src="../img/logo2.png" alt="logo" class="img-fluid"> </a>
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
                            <img src="imagenes/aleman1.png" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" alt="curso de power bi">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading ">
                            <h3 style="color:black;">Curso online a distancia</h3>
                            <h1 class="mt-4  " style=""><b>APRENDÉ <span style="font-family: montserrat_black; ">ALEMÁN DESDE CERO!</span></b></h1>
                        </div>
                        <div class="feature-list mt-4" >
                            <ul class="font-weight-light" style="font-family: montserrat_light ;" >
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;" ><i class="fas fa-check-circle text-danger"></i> 74 Clases paso a paso. Clases cortas, sencillas y al grano!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-danger"></i> Descargá el curso y miralo sin conexión a internet</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-danger"></i> Acceso para siempre al curso</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-danger"></i> Aprendes SI O SI con nuestro curso de ALEMÁN A1</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-danger"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-danger"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_regular;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Argentina. Éste precio es final y en Pesos Argentinos</p>

                        </div>
                        <div class="call-button mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top  wow flipInX animated shadow text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color:#f1cf0f;">Lo quiero</a>
                                </div>
                                <div class="col-md-6 payments">
                                    <img src="../img/securityjpg.jpg" class="img-fluid wow flipInX animated pt-md-2 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
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
        <div class="py-5 text-center mt-5 pt-5 bg-black" style="background-color:#f1cf0f;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-12">
                        <h1 class="text-white " style="font-family: montserrat_black">Una persona con conocimientos en alemán tiene hasta x5 veces mayor oportunidad laboral</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">


                        <p class="font-weight-light lead mb-4" ><span style="background-color:#f1cf0f; color:black;font-family: montserrat_bold;" class="p-1">alemán</span> Hoy en día uno de los idioma más importante del mercado y con mayor <b>facilidad para aprenderlo.</b>

                        <p class="lead mb-4">A través de este curso vas a aprender el nivel A1 en este hermoso idioma, tiempos del pasado básicos y tiempos del futuro básicos y mucho más para puedas aprender los secretos de este idioma. Explicado paso a paso en 74 clases por nuestro profesor <span style="background-color:#f1cf0f; color:black;" class="p-1 font-bold">con más de 15 años de trayectoria</span><br></p>
                        <hr>
                        <p class="lead" style="">Sin requisitos!<br></p>
                        <div class="call-button mt-5">
                            <div class="row justify-content-md-cen " >
                                <div class="col-md-5 " >
                                    <a href="checkout.php" style="background: #f1cf0f;" class="sc-roll hvr-sweep-to-top wow flipInX shadow-lg text-white " data-wow-delay="0.2s">Inscribirme</a>
                                </div>
                            </div>
                            <div class="rating-user d-inline"><br>
                                <i class="fa fa-star" ></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+450 estudiantes</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="py-5 bg text-white" style="background-color:#f1cf0f">
            <div class="container "  >
                <div class="row mx-auto">
                    <div class="col-lg-5 col-md-6 p-md-4   mx-0 px-0" > <img class="img-fluid d-block rounded shadow  " src="imagenes/aleman2.png" width="1500"> </div>
                    <div class="col-md-6 offset-lg-1 d-flex flex-column justify-content-center py-4">
                        <h2 class="my-3 mx-auto mx-md-1 mt-5 mt-md-1" style="font-family: montserrat_bold; color:#000000;"> <b>Vas a aprender:</b></h2>
                        <ul class="mx-auto mx-md-1 lead">
                            <li style="color:#f40707;"><i class="fas fa-check " style="color:#000000;"></i> Pronunciaciones en alemán</li>
                            <li style="color:#f40707;"><i class="fas fa-check  " style="color:#000000;"></i> Presentación </li>
                            <li style="color:#f40707;"><i class="fas fa-check " style="color:#000000;"></i> Verbos </li>
                            <li style="color:#f40707;"><i class="fas fa-check  " style="color:#000000;"></i> Vocabulario básico alemán</li>
                            <li style="color:#f40707;"><i class="fas fa-check " style="color:#000000;"></i> Y mucho más..! </li>
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
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="../img/certificado.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Certificado Oficial</h4>
                                <p class="mb-0">Obtené tu Certificado Oficial para adjuntar a tu CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="../img/soporte.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Comunidad online</h4>
                                <p class="mb-0">Aprende a tu ritmo, no te atamos a horarios fijos. Lo haces cuando queres!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 col-md-6">
                        <div class="card">
                            <div class="card-body p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="../img/acceso.jpg" width="150">
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Descargá el curso</h4>
                                <p class="mb-0">Vas a poder ver el curso sin conexión a internet desde cualquier parte. Te queda para siempre. </p>
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
                        <p class="mb-3"><i>"</i>Muy detallado con ejemplos claros. Soy nuevo aprendiendo alemán y me resulta muy fácil<i>"</i> </p>
                        <p class="mb-1"> <b>Maxi Fernández</b></p>
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
                        <p class="mb-3">"Muy buen curso. Tengo conocimientos básicos en alemán, este curso me ayudo a asentar algunas bases. Lo recomiendo totalmente para nuevos estudiantes"&nbsp;&nbsp;</p>
                        <p class="mb-1"> <b>Julian Guerra</b></p>
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
                        <p class="mb-1"> <b>Natalia Gómez</b></p>
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
                        <p class="mb-1"> <b>Jorge Rial</b></p>
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
                        <p class="mb-1"> <b>Fernando Romero</b></p>
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
                        <p class="mb-3"> "Empecé sin concomientos y ya estoy practicando con alumnos del grupo. Los videos son muy claros y lo mejor es que lo hago cuando quiero"</p>
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
                            <div class="card-body"> Si, podes descargarlo y te queda ¡De por vida! Una vez que abones vas a tener acceso para siempre.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas,  74 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">#3 ¿Incluye Certificación o Diploma?</button></h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample" style="">
                            <div class="card-body">Una vez termines el curso podés solicitarnos gratis el Certificado de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#4 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar alemnán desde cero!</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podés consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                    <!--TEMARIO -->
                    <div class=" index2_services float_left pt-100 pb-100 " style="background-color:#f1cf0f" >
                        <div class="container align-items-center justify-content-center rounded py-5" >
                            <h2 class="text-center text-white pb-4 f-34" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0" style="text-shadow: 2px 2px 4px #333333;"> <i class="fas fa-lightbulb"></i> Mirá todo lo que vas a aprender</h2>						 
                            <div class="row " >
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12  mx-auto" >
                                    <div id="accordion" role="tablist ">
                                        <div class="card">
                                            <!-- Card Title -->
                                            <div class="card_pagee py-4 shadow "  role="tab" id="headingSix"  >
                                                <h5 class="h5-md text-center text-dark" >
                                                    <a data-toggle="collapse" href="#collapseSix" role="button" aria-expanded="true" aria-controls="collapseSix" class="py-4  text-dark" >
                                                        Clickeame
                                                    </a>
                                                </h5>
                                            </div>
                                            <!-- Card Content -->
                                            <div id="collapseSix" id="gr" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <div class=" show ">
                                                        <br>
                                                        <p >Temario</p>
                                                        <br>
                                                        <li>Clase 1 - Alfabeto alemán</li>
                                                        <li>Clase 2 - Pronunciación de las vocales en alemán</li>
                                                        <li>Clase 3 - Pronunciación en alemán de los diptongos ie y äu</li>
                                                        <li>Clase 4 -  Pronunciación en alemán de los diptongos eu y ei</li>
                                                        <li>Clase 5 - Pronunciación en alemán de palabras con terminación ER</li>
                                                        <li>Clase 6 - Pronunciación en alemán de palabras con terminación EL</li>
                                                        <li>Clase 7 - Pronunciación en alemán de palabras con terminación EN</li>
                                                        <li>Clase 8 - Pronunciación en alemán de palabras con terminación e</li>
                                                        <li>Clase 9 - Pronunciación en alemán de la letra Eszett ß</li>
                                                        <li>Clase 10 - Pronunciación en alemán del Umlaut (die Umlaute)</li>
                                                        <li>Clase 11 - Pronunciación en alemán de la sch y s</li>
                                                        <li>Clase 12 - Como saludar y despedirse en alemán</li>
                                                        <li>Clase 13 - Cómo te llamas en alemán</li>
                                                        <li>Clase 14 - Los pronombres personales en alemán</li>
                                                        <li>Clase 15 - Conjugación de los verbos regulares en alemán en presente (1a parte)</li>
                                                        <li>Clase 16 - Conjugación de los verbos en alemán regulares en presente (2a parte)</li>
                                                        <li>Clase 17 - Conjugación de los verbos en alemán regulares en presente (3a parte)</li>
                                                        <li>Clase 19 - Los números en alemán (1-22)</li>
                                                        <li>Clase 20 - Cuántos años tienes en alemán</li>
                                                        <li>Clase 21 - Matemáticas básicas en alemán</li>
                                                        <li>Clase 22 - Vocabulario para salón de clases en alemán</li>
                                                        <li>Clase 23 - Frases en alemán para la clase</li>
                                                        <li>Clase 24 - Artículos determinados e indeterminados en alemán (nominativo)</li>
                                                        <li>Clase 25 - Reglas para el género femenino en alemán die</li>
                                                        <li>Clase 26 - Reglas para el género masculino en alemán der</li>
                                                        <li>Clase 27 - Reglas para el género neutro en alemán das</li>
                                                        <li>Clase 28 - El plural en alemán</li>
                                                        <li>Clase 29 - Negación en alemán kein en nominativo</li>
                                                        <li>Clase 30 - Negación con nicht</li>
                                                        <li>Clase 31 - Conjugación de verbos irregulares en alemán (Primera parte)</li>
                                                        <li>Clase 32 - Conjugación de verbos irregulares en alemán (Segunda parte)</li>
                                                        <li>Clase 33 - Conjugación de verbos irregulares en alemán (Tercera parte)</li>
                                                        <li>Clase 34 - Cómo hacer oraciones básicas en alemán Satzstruktur</li>
                                                        <li>Clase 35 - Partículas interrogativas en alemán</li>
                                                        <li>Clase 36 - Cómo hacer preguntas en alemán</li>
                                                        <li>Clase 37 - Los países en alemán</li>
                                                        <li>Clase 39 - Dónde vives en alemán</li>
                                                        <li>Clase 40 - Pronunciación de los idiomas en alemán</li>
                                                        <li>Clase 41 - Cuántos idiomas hablas en alemán</li>
                                                        <li>Clase 42 - Los puntos cardinales en alemán</li>
                                                        <li>Clase 43 - Las partes de una vivienda en alemán</li>
                                                        <li>Clase 44 - Los verbos separables en alemán (trennbare Verben)</li>
                                                        <li>Clase 45 - Los pronombres posesivos en alemán (Nominativo)</li>
                                                        <li>Clase 46 - Los adjetivos en alemán</li>
                                                        <li>Clase 47 - El adverbio zu</li>
                                                        <li>Clase 48 - Artículos determinados e indeterminados del acusativo en alemán</li>
                                                        <li>Clase 49 - Sustantivos compuestos en alemán</li>
                                                        <li>Clase 50 - Conjugación de los verbos en alemán sein y haben en pasado</li>
                                                        <li>Clase 51 - Los días de la semana en alemán</li>
                                                        <li>Clase 52 - Cómo disculparse en alemán</li>
                                                        <li>Clase 53 - Las bebidas en alemán</li>
                                                        <li>Clase 54 - El verbo möchten y el Konjunktiv II</li>
                                                        <li>Clase 55 - Frases básicas en alemán para el examen</li>
                                                        <li>Clase 56 - Artículos determinados e indeterminados del dativo en alemán</li>
                                                        <li>Clase 57 - Los verbos modales en alemán</li>
                                                        <li>Clase 58 - El verbo modal können en presente</li>
                                                        <li>Clase 59 - El verbo modal müssen en presente</li>
                                                        <li>Clase 60 - El verbo modal dürfen en presente</li>
                                                        <li>Clase 61 - El verbo modal sollen</li>
                                                        <li>Clase 62 - El verbo modal wollen</li>
                                                        <li>Clase 63 - Los colores en alemán</li>
                                                        <li>Clase 64 - Hablar sobre PASATIEMPOS en alemán (Hobbys und Freizeit)</li>
                                                        <li>Clase 65 - Los meses y estaciones del año en alemán</li>
                                                        <li>Clase 66 - Las direcciones en alemán</li>
                                                        <li>Clase 67 - Vocabulario para los ALIMENTOS en alemán</li>
                                                        <li>Clase 68 - Aprende el vocabulario para llenar un FORMULARIO en alemán</li>
                                                        <li>Clase 69 - Aprende las PREPOSICIONES TEMPORALES en alemán</li>
                                                        <li>Clase 70 - Aprende los MOMENTOS del día en alemán</li>
                                                        <li>Clase 71 - Reglas para la declinación en nominativo en alemán</li>
                                                        <li>Clase 72 - Reglas para la declinación del acusativo en alemán</li>
                                                        <li>Clase 73 - Aprende los NÚMEROS ORDINALES y las FECHAS en alemán</li>
                                                        <li>Clase 74 - Aprende las CONJUNCIONES COORDINANTES (UND, ODER y ABER)</li>

                                                        <br>
                                                        
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
                        <div class="row justify-content-md-center" >
                            <div class="col-md-3" >
                                <a href="checkout.php" style="background-color: #f1cf0f;" class="sc-roll hvr-sweep-to-top wow flipInX shadow text-dark" data-wow-delay="0.2s">Acceder al curso</a>
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
                            <div class="card-body"> Si, podes descargarlo y te queda ¡De por vida! Una vez que abones vas a tener acceso para siempre</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header " id="headingTwo">
                            <h5 class="mb-0 " style=""><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, 74 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN!</div>
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
                            <div class="card-body">Una vez termines el curso podés solicitarnos gratis el Certificado de Cursado.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">#5 ¿Qué requisitos tiene?</button></h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar alemán desde cero!</div>
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
                                            <div id="collapseSix" id="ch" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <div class=" show ">
                                                    <br>
                                                    <li>Clase 1 - Alfabeto alemán</li>
                                                    <li>Clase 2 - Pronunciación de las vocales en alemán</li>
                                                    <li>Clase 3 - Pronunciación en alemán de los diptongos ie y äu</li>
                                                    <li>Clase 4 -  Pronunciación en alemán de los diptongos eu y ei</li>
                                                    <li>Clase 5 - Pronunciación en alemán de palabras con terminación ER</li>
                                                    <li>Clase 6 - Pronunciación en alemán de palabras con terminación EL</li>
                                                    <li>Clase 7 - Pronunciación en alemán de palabras con terminación EN</li>
                                                    <li>Clase 8 - Pronunciación en alemán de palabras con terminación e</li>
                                                    <li>Clase 9 - Pronunciación en alemán de la letra Eszett ß</li>
                                                    <li>Clase 10 - Pronunciación en alemán del Umlaut (die Umlaute)</li>
                                                    <li>Clase 11 - Pronunciación en alemán de la sch y s</li>
                                                    <li>Clase 12 - Como saludar y despedirse en alemán</li>
                                                    <li>Clase 13 - Cómo te llamas en alemán</li>
                                                    <li>Clase 14 - Los pronombres personales en alemán</li>
                                                    <li>Clase 15 - Conjugación de los verbos regulares en alemán en presente (1a parte)</li>
                                                    <li>Clase 16 - Conjugación de los verbos en alemán regulares en presente (2a parte)</li>
                                                    <li>Clase 17 - Conjugación de los verbos en alemán regulares en presente (3a parte)</li>
                                                    <li>Clase 19 - Los números en alemán (1-22)</li>
                                                    <li>Clase 20 - Cuántos años tienes en alemán</li>
                                                    <li>Clase 21 - Matemáticas básicas en alemán</li>
                                                    <li>Clase 22 - Vocabulario para salón de clases en alemán</li>
                                                    <li>Clase 23 - Frases en alemán para la clase</li>
                                                    <li>Clase 24 - Artículos determinados e indeterminados en alemán (nominativo)</li>
                                                    <li>Clase 25 - Reglas para el género femenino en alemán die</li>
                                                    <li>Clase 26 - Reglas para el género masculino en alemán der</li>
                                                    <li>Clase 27 - Reglas para el género neutro en alemán das</li>
                                                    <li>Clase 28 - El plural en alemán</li>
                                                    <li>Clase 29 - Negación en alemán kein en nominativo</li>
                                                    <li>Clase 30 - Negación con nicht</li>
                                                    <li>Clase 31 - Conjugación de verbos irregulares en alemán (Primera parte)</li>
                                                    <li>Clase 32 - Conjugación de verbos irregulares en alemán (Segunda parte)</li>
                                                    <li>Clase 33 - Conjugación de verbos irregulares en alemán (Tercera parte)</li>
                                                    <li>Clase 34 - Cómo hacer oraciones básicas en alemán Satzstruktur</li>
                                                    <li>Clase 35 - Partículas interrogativas en alemán</li>
                                                    <li>Clase 36 - Cómo hacer preguntas en alemán</li>
                                                    <li>Clase 37 - Los países en alemán</li>
                                                    <li>Clase 39 - Dónde vives en alemán</li>
                                                    <li>Clase 40 - Pronunciación de los idiomas en alemán</li>
                                                    <li>Clase 41 - Cuántos idiomas hablas en alemán</li>
                                                    <li>Clase 42 - Los puntos cardinales en alemán</li>
                                                    <li>Clase 43 - Las partes de una vivienda en alemán</li>
                                                    <li>Clase 44 - Los verbos separables en alemán (trennbare Verben)</li>
                                                    <li>Clase 45 - Los pronombres posesivos en alemán (Nominativo)</li>
                                                    <li>Clase 46 - Los adjetivos en alemán</li>
                                                    <li>Clase 47 - El adverbio zu</li>
                                                    <li>Clase 48 - Artículos determinados e indeterminados del acusativo en alemán</li>
                                                    <li>Clase 49 - Sustantivos compuestos en alemán</li>
                                                    <li>Clase 50 - Conjugación de los verbos en alemán sein y haben en pasado</li>
                                                    <li>Clase 51 - Los días de la semana en alemán</li>
                                                    <li>Clase 52 - Cómo disculparse en alemán</li>
                                                    <li>Clase 53 - Las bebidas en alemán</li>
                                                    <li>Clase 54 - El verbo möchten y el Konjunktiv II</li>
                                                    <li>Clase 55 - Frases básicas en alemán para el examen</li>
                                                    <li>Clase 56 - Artículos determinados e indeterminados del dativo en alemán</li>
                                                    <li>Clase 57 - Los verbos modales en alemán</li>
                                                    <li>Clase 58 - El verbo modal können en presente</li>
                                                    <li>Clase 59 - El verbo modal müssen en presente</li>
                                                    <li>Clase 60 - El verbo modal dürfen en presente</li>
                                                    <li>Clase 61 - El verbo modal sollen</li>
                                                    <li>Clase 62 - El verbo modal wollen</li>
                                                    <li>Clase 63 - Los colores en alemán</li>
                                                    <li>Clase 64 - Hablar sobre PASATIEMPOS en alemán (Hobbys und Freizeit)</li>
                                                    <li>Clase 65 - Los meses y estaciones del año en alemán</li>
                                                    <li>Clase 66 - Las direcciones en alemán</li>
                                                    <li>Clase 67 - Vocabulario para los ALIMENTOS en alemán</li>
                                                    <li>Clase 68 - Aprende el vocabulario para llenar un FORMULARIO en alemán</li>
                                                    <li>Clase 69 - Aprende las PREPOSICIONES TEMPORALES en alemán</li>
                                                    <li>Clase 70 - Aprende los MOMENTOS del día en alemán</li>
                                                    <li>Clase 71 - Reglas para la declinación en nominativo en alemán</li>
                                                    <li>Clase 72 - Reglas para la declinación del acusativo en alemán</li>
                                                    <li>Clase 73 - Aprende los NÚMEROS ORDINALES y las FECHAS en alemán</li>
                                                    <li>Clase 74 - Aprende las CONJUNCIONES COORDINANTES (UND, ODER y ABER)</li>

                                                        	  	 
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
                                <a href="checkout.php" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color: #f1cf0f;">Lo quiero </a>
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
                            <img src="imagenes/aleman2.png" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Sumá alemán a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Pago por única vez en Pesos Argentinos (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_bold;"><strike><?= $precioCursoOficial ?></strike><span class="font-weight-bold "> <?= $precioCurso ?></span></h3>       </div>
                        <div class="call-button mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top  wow flipInX animated text-dark shadow" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; background-color: #f1cf0f;">Inscribirme</a>
                                </div>
                                <div class="col-md-6 payments ">
                                    <img src="../img/securityjpg.jpg" class="img-fluid wow flipInX animated px-5 px-md-0 mt-md-0 mt-3 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include('../a-pages/timerFooter.php') ?>
        
        <?php include('../a-pages/footerTM.php') ?>

        <script>
            fbq('track', 'ViewContent');
        </script>
        <script>
            fbq('trackCustom', 'visitas aleman');
        </script>
    </body>

</html>

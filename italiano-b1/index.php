<?php
$dirpage = '../';
$idcurso = 'italiano_b1';
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
        <title>Aprende Idiomas - Cursos Online</title>
        <?php include('../a-pages/headerTM.php') ?>
                                <link rel="stylesheet" href="https://app.gandaweb.com/chat-style.css?token=CGKGG7HKmfYbL41AoIAaY6j5s6x38ThcBOddfhd7BPIgpVYbqOHdugFlP2c1">
        <style>
            @media (max-width: 600px) {
                .chat-container {
    position: fixed;
    bottom: 150px;
    right: 0px;
    left: 0px;
    width: 100%;
    font-weight: bolder;
}
}


        </style>
    </head>

    <body style="font-family: montserrat_regular;">
        
        <?php include('../a-pages/timer.php') ?>
        
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
                        <a class="hvr-sweep-to-right bg-danger text-white" href="checkout.php">Lo quiero</a>
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
                            <img src="img/italiano10.jpg" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" alt="curso de power bi">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading ">
                            <h3 style="color:black;">Curso online a distancia</h3>
                            <h1 class="mt-4  " style=""><b>APRENDÉ <span style="font-family: montserrat_black ;">ITALIANO NIVEL AVANZADO!</span></b></h1>
                        </div>
                        <div class="feature-list mt-4">
                            <ul class="font-weight-light" style="font-family: montserrat_light ;">
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;"><i class="fas fa-check-circle text-dark"></i> + 23 clases paso a paso!</li>
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;"><i class="fas fa-check-circle text-dark"></i> Nivel B1</li>
								<li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;"><i class="fas fa-check-circle text-dark"></i> Sirve para Ciudadanía Italiana</li>
								<li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Mira el curso desde cualquier dispositivo!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Ayuda de los profesores online </li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-dark"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-dark"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center bg-success text-white" style="background-color:#f3c910; color:black;font-family: montserrat_regular;"><strike>$19.998</strike><span class="font-weight-bold "> $9.999</span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Argentina. Éste precio es final y en Pesos Argentinos</p>
                        </div>
                        <div class="call-button mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top wow flipInX animated shadow bg-danger text-white" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color:#f3c910;">Lo quiero</a>
                                </div>
                                <div class="col-md-6 payments">
                                    <img src="img/security.png" class="img-fluid wow flipInX animated pt-md-2 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                        <div class="review-one mt-5 mt-md-3">
                            <div class="review-text">
                                <h5 style="font-family: montserrat_regular" class="font-weight-light">"Muy bueno el curso, la verdad lo recomiendo"</h5>
                            </div>
                            <div class="review-image">
                                <p class="user_name d-inline" style="font-family: montserrat_bold;">Julieta Salcedo<i class="ml-3 fa fa-star" style="color:#ffd322;"></i>
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
        <div class="py-5 text-center mt-5 pt-5 bg-black bg-success" style="background-color:#23AFFA;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-12">
                        <h1 class="text-white " style="font-family: montserrat_black">La mejor forma de aprender italiano a nivel mundial</h1>
						<p>
						<h1 class="text-white " style="font-family: montserrat_black">Realizando este curso estás preparado para solicitar Ciudadanía Italiana</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">
                        <p class="font-weight-light lead mb-4">Hablado por más de 70 millones de personas, el italiano te va a ayudar a navegar las calles de Roma en tu próximo viaje al extranjero. El italiano es la lengua romance arquetípica, y un buen punto de partida para aprender otros idiomas derivados del latín.. </p>
                        <p class="lead mb-4">A través de este curso vas a aprender los verbos más usados, tiempos verbales básicos y mucho más para puedas mantener una conversación fluida. Explicado paso a paso en más de 20 clases paso a paso por nuestro profesora <span style="background-color:black; color:white;" class="p-1 font-w"> y traductora de Italiano</span><br></p>
                        <hr>
                        <p class="lead" style="">Sin requisitos!<br></p>
                        <div class="call-button mt-5">
                            <div class="row justify-content-md-cen">
                                <div class="col-md-5">
                                    <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow-lg bg-success text-white" data-wow-delay="0.2s">Inscribirme</a>
                                </div>
                            </div>
                            <div class="rating-user d-inline"><br>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+750 estudiantes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 bg text-white bg-success" style="background-color:#23AFFA">
            <div class="container ">
                <div class="row mx-auto">
                    <div class="col-lg-5 col-md-6 p-md-4   mx-0 px-0"> <img class="img-fluid d-block rounded shadow  " src="img/italiana2.jpg" width="1500"> </div>
                    <div class="col-md-6 offset-lg-1 d-flex flex-column justify-content-center py-4">
                        <h2 class="my-3 mx-auto mx-md-1 mt-5 mt-md-1" style="font-family: montserrat_bold"> <b>Vas a aprender:</b></h2>
                        <ul class="mx-auto mx-md-1 lead">
                            <li><i class="fas fa-check text-body" style="color:#f3c910;"></i> Tiempos verbales</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Gramática</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Pronombres más usados</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Vocabulario avanzado para conversar</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Lecturas</li>
                            <li><i class="fas fa-check text-dark" style="color:#f3c910;"></i> Ejercicios y mucho más!</li>
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
                                <h4 class="font-weight-bold" style="font-family: montserrat_bold">Acceso online</h4>
                                <p class="mb-0">Hacelo a tu ritmo y sin horarios</p>
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
                        <p class="mb-3">"Un saludo a la profe, excelente"</p>
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
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">#1 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podés consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, Con un total de duración de 23 clases en 8 horas de curso para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">#3 ¿Dan material práctico?</button></h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Sí! Contamos con ejercicios dentro de la plataforma para que puedas practicar</div>
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
        <div class="index2_services float_left pt-100 pb-100 bg-success" id="gr" style="background-color:#d52d7a">
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
                                            <br>
													<li>Lezione n1- L'imperfetto.</li>
                                                    <li>Lezione n2 - la famiglia e le relazioni</li>
                                                    <li>Lezione n3- il condizionale semplice e composto</li>
                                                    <li>lezione n4- le professioni</li>
                                                    <li>Lezione n5 - Los pronombres reflexivos y recíprocos</li>
													<li>Lezione n6- La comida y la cocina italiana</li>                                                    
                                                    <li>Lezione n7- El uso de los pronombres directos e indirectos</li>
                                                    <li>Lezione n8 - il corpo umano e la salute</li>
                                                    <li>Lezione n9 - I pronomi relativi</li>
                                                    <li>Lezione n10- Gli aggettivi possessivi e dimostrativi parte 1</li>
													<li>Lezione n10- Gli aggettivi possessivi e dimostrativi parte 2</li>
													<li>Lezione n11-Ropa y moda expresiones lingüísticas</li>
                                                    <li>Lezione n12- I pronomi interrogativi</li>
                                                    <li>Lezione n13 - la natura e l'ambiente</li>
                                                    <li>Lezione n14- I verbi modali</li>
                                                    <li>Lezione n15- i paesi e le culture straniere</li>
                                                    <li>Lezione n16- La voce passiva</li>
                                                    <li>Lezione n17- I verbi pronominali</li>
                                                    <li>Lezione n18- I mezzi di comunicazione e le tecnologie. Espressioni colloquiali</li>
                                                    <li>Lezione n19- i comparativi e i superlativi</li>
                                                    <li>Lezione n20- cinema e musica</li>
													<li>Lezione n21- Eventi culturali e festività locali</li>
													<li>Lezione n22- L'uso delle congiunzioni</li>
													<li>Lezione n23- i tempi verbali</li>
                                            <br>
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
        <section id="ch">
            <div class="container">
                <div class="section-heading ">
                    <h2 class="mt-2 mb-1 pb-3 text-dark" style="font-family: montserrat_bold"><i class="fa fa-question-circle" aria-hidden="true">&nbsp;</i>Preguntas Frecuentes&nbsp;</h2>
                </div>
                <div class="accordion mt-4" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0" style="">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">#1 ¿Dan soporte?</button></h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample" style="">
                            <div class="card-body">Si damos soporte 24/7. Podés consultar cualquier duda en nuestro e-mail</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header " id="headingTwo">
                            <h5 class="mb-0 " style=""><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                            <div class="card-body"> Lo que vos decidas, Con un total de duración de 23 clases en 8 horas de curso para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">#3 ¿Dan material práctico?</button></h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Sí! Contamos con ejercicios dentro de la plataforma para que puedas practicar</div>
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
                                                    <br>
													<li>Lezione n1- L'imperfetto.</li>
                                                    <li>Lezione n2 - la famiglia e le relazioni</li>
                                                    <li>Lezione n3- il condizionale semplice e composto</li>
                                                    <li>lezione n4- le professioni</li>
                                                    <li>Lezione n5 - Los pronombres reflexivos y recíprocos</li>
													<li>Lezione n6- La comida y la cocina italiana</li>                                                    
                                                    <li>Lezione n7- El uso de los pronombres directos e indirectos</li>
                                                    <li>Lezione n8 - il corpo umano e la salute</li>
                                                    <li>Lezione n9 - I pronomi relativi</li>
                                                    <li>Lezione n10- Gli aggettivi possessivi e dimostrativi parte 1</li>
													<li>Lezione n10- Gli aggettivi possessivi e dimostrativi parte 2</li>
													<li>Lezione n11-Ropa y moda expresiones lingüísticas</li>
                                                    <li>Lezione n12- I pronomi interrogativi</li>
                                                    <li>Lezione n13 - la natura e l'ambiente</li>
                                                    <li>Lezione n14- I verbi modali</li>
                                                    <li>Lezione n15- i paesi e le culture straniere</li>
                                                    <li>Lezione n16- La voce passiva</li>
                                                    <li>Lezione n17- I verbi pronominali</li>
                                                    <li>Lezione n18- I mezzi di comunicazione e le tecnologie. Espressioni colloquiali</li>
                                                    <li>Lezione n19- i comparativi e i superlativi</li>
                                                    <li>Lezione n20- cinema e musica</li>
													<li>Lezione n21- Eventi culturali e festività locali</li>
													<li>Lezione n22- L'uso delle congiunzioni</li>
													<li>Lezione n23- i tempi verbali</li>
                                          			<br>
                                                    <br>
                                                    <a href="" class="sc-roll hvr-sweep-to-top  wow flipInX animated text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;"><b>Querés más conocimientos? Mira el nivel 2 👉 </b></a>
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
                            <img src="img/italiana2.jpg" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Sumá Italiano a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Sirve para aplicar para la CIUDADANÍA ITALIANA
							<p> • Pago por única vez en Pesos Argentinos (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center bg-danger text-white" style="background-color:#f3c910; color:black;font-family: montserrat_bold;"><strike>$19.998</strike><span class="font-weight-bold "> $9.999</span></h3>
                        </div>
                        <div class="call-button mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top wow flipInX animated shadow text-white bg-success" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s;">Inscribirme</a>
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
        
        <?php include('../a-pages/timerFooter.php') ?>
        
        <?php include('../a-pages/footerTM.php') ?>
        
        <script>
            fbq('track', 'ViewContent');
        </script>
        <script>
            fbq('trackCustom', 'visitas italiano');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>
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
        <script src="https://app.gandaweb.com/chat-script.js?token=CGKGG7HKmfYbL41AoIAaY6j5s6x38ThcBOddfhd7BPIgpVYbqOHdugFlP2c1"></script>
    </body>
</html>
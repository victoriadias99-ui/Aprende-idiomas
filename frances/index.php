<?php

     
$dirpage = '../';
$idcurso = 'ingles_uno';


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
        <header>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <a href="./" target="_blank"><img src="img/logo.jpg" alt="logo" class="img-fluid"> </a>
                    </div>
                    <div class="col-md-3 hdphone">
                        <p> Aprendé a distancia</p>
                    </div>
                    <div class="col-md-3 hdphone">
                        <img src="img/securityjpg.jpg" alt="security" class="img-fluid">
                    </div>
                    <div class="col-md-3 cta-button  col-sm-6 col-6">
                        <a class="hvr-sweep-to-right" href="checkout.php">Lo quiero</a>
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
                            <img src="img/1.png" class="img-fluid my-auto py-auto align-items-center justify-content-center pt-5 pt-md-5 mt-md-5" alt="curso de power bi">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading ">
                            <h3 style="color:black;">Curso online a distancia</h3>
                            <h1 class="mt-4  " style=""><b>APRENDÉ <span style="font-family: montserrat_black ;">FRANCÉS DESDE CERO!</span></b></h1>
                        </div>
                        <div class="feature-list mt-4" >
                            <ul class="font-weight-light" style="font-family: montserrat_light ;" >
                                <li class="wow fadeIn  animated" data-wow-delay="0.1" style="visibility: visible;-webkit-animation-delay: 0.1; -moz-animation-delay: 0.1; animation-delay: 0.1;" ><i class="fas fa-check-circle text-dark"></i> 2 hs de video paso a paso!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Descargá el curso y miralo sin conexión a internet!</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Acceso para siempre al curso</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.2" style="visibility: visible;-webkit-animation-delay: 0.2; -moz-animation-delay: 0.2; animation-delay: 0.2;"> <i class="fas fa-check-circle text-dark"></i> Ayuda de los profesores online </li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;"><i class="fas fa-check-circle text-dark"></i> Otorgamos Certificado Oficial</li>
                                <li class="wow fadeIn animated" data-wow-delay="0.3" style="visibility: visible;-webkit-animation-delay: 0.3; -moz-animation-delay: 0.3; animation-delay: 0.3;"><i class="fas fa-check-circle text-dark"></i> Estudialo desde tu PC, notebook, tablet o Celular</li>			
                            </ul>
                            <h3 class="mt-md-4 p-2 mt-3 col-8 col-md-6 text-center" style="background-color:#f3c910; color:black;font-family: montserrat_regular;"><strike><?= $precioCursoOficial ?></strike>
							<span class="font-weight-bold "><?= $precioCurso ?></span></h3>
                            <p style="font-family: montserrat_bold">Aprende Idiomas es una empresa Argentina. Éste precio es final y en Pesos Argentinos</p>
                        </div>
                        <div class="call-button mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="checkout.php" class="hvr-sweep-to-top  wow flipInX animated shadow text-dark" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s; background-color:#f3c910;">Lo quiero</a>
                                </div>
                                <div class="col-md-6 payments">
                                    <img src="img/security.png" class="img-fluid wow flipInX animated pt-md-2 " data-wow-delay="0.3s" alt="payments" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                </div>
                            </div>
                        </div>
                        <div class="review-one mt-5 mt-md-3">
                            <div class="review-text">
                                <h5 style="font-family: montserrat_regular" class="font-weight-light">"Ideal para principiantes,la verdad que me encantó lo recomiendo"</h5>
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
        <div class="py-5 text-center mt-5 pt-5 bg-black" style="background-color:#051440;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-12">
                        <h1 class="text-white " style="font-family: montserrat_black">Una persona con conocimientos en francés tiene hasta 5 veces mayor oportunidad laboral</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 align-items-center d-flex" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 px-md-5 mx-auto" style="">


                        <p class="font-weight-light lead mb-4" ><span style="background-color:#f3c910; color:black;font-family: montserrat_bold;" class="p-1">Francés</span> Hoy en día es el idioma más importante del mercado y con mayor <b>facilidad para aprenderlo.</b>

                        <p class="lead mb-4">A través de este curso vas a aprender los verbos más usados, tiempos verbales básicos y mucho más para puedas mantener una conversación fluida. Explicado paso a paso en un video de 2 hs por nuestro profesor <span style="background-color:black; color:white;" class="p-1 font-w">con más de 15 años de trayectoria</span><br></p>
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
                            <p class="user_name d-inline pl-4 pr-4 font-weight-light">+600 estudiantes</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="py-5 bg text-white" style="background-color:#051440">
            <div class="container "  >
                <div class="row mx-auto">
                    <div class="col-lg-5 col-md-6 p-md-4   mx-0 px-0" > <img class="img-fluid d-block rounded shadow  " src="img/2.png" width="1500"> </div>
                    <div class="col-md-6 offset-lg-1 d-flex flex-column justify-content-center py-4">
                        <h2 class="my-3 mx-auto mx-md-1 mt-5 mt-md-1" style="font-family: montserrat_bold"> <b>Vas a aprender:</b></h2>
                        <ul class="mx-auto mx-md-1 lead">
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Modulo 1 - Conocernos</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Modulo 2 - Presentarse y dar información personal</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Modulo 3 - Hablar de la vida cotidiana y la rutina en presente.</li>
                            <li><i class="fas fa-check " style="color:#f3c910;"></i> Modulo 4 - Formuler des questions</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Modulo 5 - Anécdota</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Modulo 6 - Viajes</li>
                            <li><i class="fas fa-check  " style="color:#f3c910;"></i> Modulo 7 - Compras e ir a restaurant</li>
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
                                <p class="mb-0">Contamos con un espacio para que puedas practicar tu Francés con otros alumnos</p>
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
                        <p class="mb-3"><i></i>"Excelente curso de Francés"<i></i> </p>
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
                        <p class="mb-3">"Muy bueno el curso solamente tuve experiencia en la secundaria y este curso me ayudó a impulsarme definitivamente en Francés"&nbsp;&nbsp;</p>
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
                        <p class="mb-3">"Muy práctico y didactico. Buenos ejemplos de la vida cotidiana. Me sirvio" </p>
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
                            <div class="card-body"> ¡De por vida! Una vez que abones vas a tener acceso para siempre, vas a poder descargar el curso y verlo desde cualquier lugar sin conexión a internet.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0" style=""><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">#2 ¿Cuánto dura el curso?</button></h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                            <div class="card-body">Lo que vos decidas, + 45 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.</div>
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
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar Francés desde cero o refuerzes tus conocimientos!</div>
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
                                <a href="checkout.php" class="sc-roll hvr-sweep-to-top wow flipInX shadow text-dark" data-wow-delay="0.2s">Acceder al curso</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <!--TEMARIO -->
        <div class=" index2_services float_left pt-100 pb-100 " id="gr" style="background-color:#051440" >
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
                                <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion" style="">
                                    <div class="card-body">
                                        <div class=" show ">
                                            <br>
                                            <b>Módulo 1 - Conocernos</b><br>
                                            <li>Alfabeto</li>
                                            <li>Acentos</li>
                                            <li>Vocales</li>
                                            <li>Articulos</li>
                                            <li>Vocal nasal</li>
                                            <li>Conjugacion verbos</li>
                                            <br>
                                            <b>Módulo 2 - Presentarse y dar información persona</b><br>		  
                                            <li>Le verbe etre</li>
                                            <li>Le verbe avoir</li>
                                            <li>Les adjectifs qualificatifs</li>
                                            <li>Le verbe puvoir</li>
                                            <li>Le verbe vouloir</li>
                                            <li>Le verbe devoir</li>
                                            <li>Le verbe connaitre</li>       
                                            <br>
                                            <b>Módulo 3 - Hablar de la vida cotidiana y la rutina en presente.</b><br>
                                            <li>La famille</li>   
                                            <li>Les adjectifs possessifs</li>   
                                            <li>Les activités quotidiennes</li>   
                                            <li>Les adverbes de frequence</li>   
                                            <li>Verbes du 2 groupe: verbes en-IR</li>   
                                            <li>Verbes du 3 groupe: tous les irréguliers</li>     
                                            <br>
                                            <b>Módulo 4 - Formuler des questions</b><br>
                                            <li>La négation</li>   
                                            <li>Les questions</li>   
                                            <li>La cause</li>   
                                            <li>La conséquence</li>   
                                            <li>Répondre oui, si, non</li>      
                                            <br>
                                            <b>Módulo 5 - Anécdota</b><br>
                                            <li>Passé composé: découverte</li>   
                                            <li>Passé composé: l'auxiliaire</li> 
                                            <li>Passé composé; participe passé</li>  
                                            <li>L'imparfait: découverte</li>  
                                            <li>L'imparafit: formation</li>     
                                            <br>
                                            <b>Módulo 6 - Viajes</b><br>
                                            <li>Le futur proche</li>   
                                            <li>Le turut simple</li> 
                                            <li>Les prépositions des villes et des pays</li>  
                                            <li>Les vetements</li>  
                                            <li>La météo</li>  
                                            <li>Les voyages</li> 
                                            <br>
                                            <b>Módulo 7 - Compras e ir a restaurant</b><br>
                                            <li>Les aliments</li>   
                                            <li>Les articles partitifs</li> 
                                            <li>Les pronoms toniques</li>  
                                            <li>Les achats</li>  
                                            <li>Le mode conditionnel</li> 
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
                            <div class="card-body"> Lo que vos decidas, + 45 clases para que hagas a tu ritmo y si decidís seguir practicando el curso no tiene FIN! ya que contamos con un espacio para que puedas conversar con alumnos y practicar ejercicios.
                            </div>
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
                            <div class="card-body">No hay requisitos previos, este curso es para que comiences a estudiar Francés desde cero o refuerzes tus conocimientos!</div>
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
                <div class=" index2_services float_left pt-100 pb-100 " style="background-color:#051440" >
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
                                            <b>Módulo 1 - Conocernos</b><br>
                                            <li>Alfabeto</li>
                                            <li>Acentos</li>
                                            <li>Vocales</li>
                                            <li>Articulos</li>
                                            <li>Vocal nasal</li>
                                            <li>Conjugacion verbos</li>
                                            <br>
                                            <b>Módulo 2 - Presentarse y dar información persona</b><br>		  
                                            <li>Le verbe etre</li>
                                            <li>Le verbe avoir</li>
                                            <li>Les adjectifs qualificatifs</li>
                                            <li>Le verbe puvoir</li>
                                            <li>Le verbe vouloir</li>
                                            <li>Le verbe devoir</li>
                                            <li>Le verbe connaitre</li>       
                                            <br>
                                            <b>Módulo 3 - Hablar de la vida cotidiana y la rutina en presente.</b><br>
                                            <li>La famille</li>   
                                            <li>Les adjectifs possessifs</li>   
                                            <li>Les activités quotidiennes</li>   
                                            <li>Les adverbes de frequence</li>   
                                            <li>Verbes du 2 groupe: verbes en-IR</li>   
                                            <li>Verbes du 3 groupe: tous les irréguliers</li>     
                                            <br>
                                            <b>Módulo 4 - Formuler des questions</b><br>
                                            <li>La négation</li>   
                                            <li>Les questions</li>   
                                            <li>La cause</li>   
                                            <li>La conséquence</li>   
                                            <li>Répondre oui, si, non</li>      
                                            <br>
                                            <b>Módulo 5 - Anécdota</b><br>
                                            <li>Passé composé: découverte</li>   
                                            <li>Passé composé: l'auxiliaire</li> 
                                            <li>Passé composé; participe passé</li>  
                                            <li>L'imparfait: découverte</li>  
                                            <li>L'imparafit: formation</li>     
                                            <br>
                                            <b>Módulo 6 - Viajes</b><br>
                                            <li>Le futur proche</li>   
                                            <li>Le turut simple</li> 
                                            <li>Les prépositions des villes et des pays</li>  
                                            <li>Les vetements</li>  
                                            <li>La météo</li>  
                                            <li>Les voyages</li> 
                                            <br>
                                            <b>Módulo 7 - Compras e ir a restaurant</b><br>
                                            <li>Les aliments</li>   
                                            <li>Les articles partitifs</li> 
                                            <li>Les pronoms toniques</li>  
                                            <li>Les achats</li>  
                                            <li>Le mode conditionnel</li> 
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
                            <img src="img/1.png" class="img-fluid rounded shadow" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6" style="">
                        <div class="section-heading">
                            <h3>
                            </h3>
                            <h1 class="font-weight-bold text-left" style="font-family: montserrat_black">Sumá Francés a tu CV</h1>
                        </div>
                        <div class="feature-list mt-4">
                            <p> • Pago por única vez en Pesos Argentinos (sin suscripciones ni pagos mensuales). <br>• Garantía de devolución de 7 días</p>
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
        
        <?php include('../a-pages/footerTM.php') ?>
        
        <script>
            fbq('track', 'ViewContent');
        </script>
        <script>
            fbq('trackCustom', 'visitas frances');
        </script>
    </body>
</html>

<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$titulo = 'Realizar compra';
$dirpage = '../'; // Esta variable tiene como valor la dirección de la raiz del proyecto
$curso = 'ingles_dos'; // Variable que contiene el id del curso a visualizar

include("../a-includes/funcionsDBStripe.php");
include("../a-includes/logicparametros.php");
require ("../a-includes/Funciones.php");

$producto = getDataProductoCheckout($curso, $moneda, $country_code);
if (isset($_GET['test']) && $_GET['test'] == 1) {
    echo "<pre>";
    print_r($producto);
    echo "</pre>";
}
$simbolo = $producto['producto']['SIMBOLO'];
$precio = Funciones::getFormatMoneda($producto['producto']['PRECIO'], $simbolo, $producto['producto']['MONEDA']);
$moneda = $producto['producto']['MONEDA'];

$valPrecio = floatval($producto['producto']['PRECIO']);
$valPrecioOferta = floatval($producto['producto']['PRECIO_DESC']);
$valPrecioDescuento = floatval($valPrecio - $valPrecioOferta);
$precioOferta = Funciones::getFormatMoneda($valPrecioOferta, $simbolo, $producto['producto']['MONEDA']);
$precioDescuento = Funciones::getFormatMoneda($valPrecioDescuento, $simbolo, $producto['producto']['MONEDA']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tu Carrito </title>
        <?php include('../a-pages/header.php') ?>
        <style> .whatsap-flotante {
                bottom:10px;
                right:4px;
                position: fixed;
                _position:absolute;
                clip:inherit;
                _top:expression(document.documentElement.scrollTop+document.documentElement.clientHeight-this.clientHeight);
                _right:expression(document.documentElement.scrollLeft+ document.documentElement.clientWidth - offsetWidth);
            }
            .blanco {
                background-color: white;
                color: black;
            }

            .crema {
                background-color: #f4f5f9;
            }

            .botonmp1{
                background-color: #2eb000;
                color:white;
                width:100%;
                font-size:23px;
                text-align: center;
                border-radius: 5px;
                padding-top:20px;
                padding-bottom: 20px;
            }
            .botonmp1:hover {
                color:white;
                background-color: #36cf00;
            }

            @media only screen and (max-width:500px)
            {
                .m-form{
                    flex: 100%;
                    max-width: 100%;
                }
            }

        </style>
    </head>
    <body style="font-family: montserrat_regular;">
        <!-- Website Header -->
        <header  class="bg-dark ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <a href="/" target="_blank"> <img src="img/logo2.png" alt="logo" class="img-fluid" width=""> </a>
                    </div>
                    <div class="col-md-3 hdphone" style='color:white'>
                        <p><b>Curso a distancia online</b></p>
                    </div>
                </div>
            </div>
        </header>
        <!-- Website Sections -->
        <div class="pt-5" style="background-color:#00a8f3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  mr-auto order-2 order-md-1"> <img class="img-fluid d-block" src="img/ingles-producto2.jpg"> </div>
                    <div class="px-md-5 p-3 d-flex flex-column align-items-start justify-content-center col-md-7 order-1 order-md-2" style="color:white">
                        <h1 style="font-family: montserrat">Estas a un paso!</h1>
                        <h1 style="font-family: montserrat_bold;">Accede hoy y obtén acceso ilimitado</h1> 
                        <div class="row text-muted">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-white jp_banner_jobs_categories_wrapper bg-white float_left pt-5 pb-0 mx-auto mx-1">
            <div class="container bg-light rounded ">
                <div class="row ">
                    <div class="col-md-5 mx-auto  my-auto" style="padding: 80px 20px;">
                        <h4 class="d-flex justify-content-between mb-3"> <span class="text-muted"><b>Resumen</b></span> </h4>
                        <?php
                        foreach ($producto['pack'] as $upsell) {
                            $precioItem = $upsell['PRECIO'];
                            ?>
                            <div class="p-3 mb-3" style="color:black; border-style: dashed;border-width:2px;;background-color: rgba(255, 234, 118, 0.3); "> 
                                <i class="fas fa-arrow-alt-circle-right text-danger blink"></i> 
                                <input type="checkbox" id="up_<?= $upsell['ID_ABRE'] ?>" value="<?= $upsell['ID_ABRE'] ?>" class="check-producto-paquete"> 
                                <b><?= str_replace('{#MONTO}', Funciones::getFormatMoneda($precioItem, $simbolo, $upsell['MONEDA']), $upsell['TITULO']) ?></b>
                                <p class="mt-2  px-3 "><?= str_replace('{#MONTO}', Funciones::getFormatMoneda($precioItem, $simbolo, $upsell['MONEDA']), $upsell['DESCRIPCION']) ?>
                            </div>
                        <?php } ?>

                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-0 text-dark">Curso de Inglés Nivel 2</h6> <small class="text-muted">De por vida</small>
                                </div> 
                                <span class="text-muted"><?= $precio ?></span>
                            </li>


                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-0 text-danger"><b>Oferta 🔥</b></h6> <small class="text-muted"></small>
                                </div> <span class="text-danger">- <?= $precioDescuento ?></span>
                            </li>
                            <?php
                            foreach ($producto['pack'] as $c => $item) {
                                $precioItem = $item['PRECIO'];
                                ?>
                                <li class="list-group-item d-flex justify-content-between" id="item_<?= $item['ID_ABRE'] ?>" style="">
                                    <input type="number" id="<?= $item['ID_ABRE'] ?>_item_price" value="<?= $precioItem ?>" hidden>
                                    <div>
                                        <h6 class="my-0 text-success font-weight-bold"><b><?= $item['NOMBRE'] ?></b></h6> <small class="text-muted">De por vida</small>
                                    </div> <span class="text-muted"><?= Funciones::getFormatMoneda($precioItem, $simbolo, $item['MONEDA']) ?></span>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="list-group-item d-flex justify-content-between text-dark"> <span>Total</span> <b id="total_price"><?= $precioOferta ?><br></b></li>

                        </ul>


                        <p class="text-left mt-2 ml-1  text-dark">• Pago por única vez.</p>
                        <hr>

                        <div class="row mx-2 ">
                            <div class="col-md-12 text-dark">
                                <p class="mt-3 pb-2" style="font-family: montserrat_bold;"> ¿Por qué elegir Aprende Idiomas? </p>
                                <ul>
                                    <li> <i class="fas fa-check-square " style="color:#00a8f3;"></i> Descarga el curso y míralo sin conexión!</li>
                                    <li> <i class="fas fa-check-square " style="color:#00a8f3;"></i> +35 clases</li>
                                    <li> <i class="fas fa-check-square " style="color:#00a8f3;"></i> +100 Ejercicios Prácticos</li>
                                    <li> <i class="fas fa-check-square " style="color:#00a8f3;"></i> Acceso ilimitado</li>
                                    <li> <i class="fas fa-check-square " style="color:#00a8f3;"></i> Soporte 24 horas ante cualquier duda</li>
                                    <li><i class="fas fa-check-square " style="color:#00a8f3;"></i> Grupo privado de alumnos</li>
                                    <li><i class="fas fa-check-square " style="color:#00a8f3;"></i> Videos bien explicados paso a paso</li>
                                </ul>
                                <hr>
                            </div>

                            <div class=" col-md-12" style="">
                                <div class=" mb-0 text-dark">
                                    <p>"Realicé el nivel 1 y 2 muy completos mas de 80 clases!
                                        Explica muy bien el profesor".
                                    </p>
                                    <div class="rating-user d-inline">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="blockquote-footer">
                                        <b>Martin Fleitas</b>, Ciudad de Mexico</div>
                                </div>
                                <hr>
                                <div class=" mb-0 text-dark">
                                    <p>"Clases precisas, muy bueno la verdad".
                                    </p>
                                    <div class="rating-user d-inline">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="blockquote-footer">
                                        <b>Micaela Gonzalez</b>, Colombia</div>
                                </div>
                                <hr>
                                <div class=" mb-0 text-dark">
                                    <p>"Hice ambos cursos felicito al profesor".
                                    </p>
                                    <div class="rating-user d-inline">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>    
                                    </div>
                                    <div class="blockquote-footer">
                                        <b>Sofia Coria</b>, Provincia de Buenos Aires</div>
                                </div>
                            </div>

                        </div>  
                        <hr>

                    </div>

                    <div class="col-md-6 order-md-2 my-auto col-xl-5 " id="arriba" >

                        <?php include('../a-pages/form.php') ?>
                    </div>

                </div>
                <hr>
            </div>


            <div class="py-5 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-dark">
                            <h3 style="font-family:montserrat_bold">¿Quieres hablar con nosotros? ¡Escríbenos ahora!</h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4 text-center">
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="" target="_blank" href="https://api.whatsapp.com/send?phone=5491160478541&amp;text=Hola!%20Te%20escribo%20por%20el%20Curso%20de%20Inglés"> <img class="img-fluid d-block mx-auto mx-md-1" src="img/whatsapp.jpg"></a>
                        </div>
                        <div class="col-md-4 text-center">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container row mt-5 mx-auto text-dark">
                <div class="col-md-4 col-4">
                    <img class="img-fluid d-block mx-auto" src="img/badge1.jpg" draggable="true">
                    <p class=" text-center" draggable="true">Protegemos tu privacidad</p>
                </div>
                <div class="col-md-4 col-4">
                    <img class="img-fluid d-block mx-auto" src="img/badge2.jpg">
                    <p class="pi-draggable text-center" draggable="true">Tus datos están seguros</p>
                </div>
                <div class="col-md-4 col-4">
                    <img class="img-fluid d-block mx-auto" src="img/badge3.jpg">
                    <p class="pi-draggable text-center">Garantía de satisfacción 100%</p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <?php include('../a-pages/footer.php') ?>

            <script src="../libraries/js/checkout-stripe.js"></script>
            <script src="https://js.stripe.com/v3/"></script>
            <!-- upsell -->
            <script>
<?php
foreach ($producto['pack'] as $c => $item) {
    echo '$("#item_' . $item['ID_ABRE'] . '").attr("style", "display: none!important");';
}
?>
                $(".check-producto-paquete").on("click", function () {
                    var inputs = new Array();
                    inputs = $("#pack").val().split('|');
                    var idProducto = $(this).val();

                    var amount = parseFloat($("#amount").val());
                    var amountPack = parseFloat($("#" + idProducto + "_item_price").val());

                    if ($(this).is(":checked")) {
                        $("#item_" + idProducto + "").attr('style', '');
                        amount += amountPack;
                        inputs.push(idProducto);
                    } else {
                        $("#item_" + idProducto + "").attr('style', 'display: none!important');
                        inputs = inputs.filter(function (elem) {
                            return elem != idProducto;
                        });
                        amount -= amountPack;
                    }
                    $("#pack").val(inputs.join("|"));
                    $("#amount").val(parseFloat(amount).toFixed(1));
                    $("#total_price").html($('#simbolo').val() + getFloatValue(amount) + ' ' + $('#moneda').val());

                    inputs = $("#pack").val().split('|');
                    var arrayUpsell = inputs.sort();
                    var idCodeUpsell = '';
                    arrayUpsell.forEach(function (element) {
                        idCodeUpsell += ('' + element + '');
                    });
                    //console.log(arrayUpsell);
                    //console.log(idCodeUpsell);
                    $("#pack").val(arrayUpsell.join('|'));
                });

                $('#curso').val('<?= $curso ?>');

                function getFloatValue(value) {
                    var monto = parseFloat(Math.round(value * 100) / 100) + '';
                    var m1 = Array.from(monto.split('.'));
                    var m2 = Array.from(m1[0]);
                    m2 = m2.reverse();
                    var strValA = '';
                    var cont = 0;
                    for (var i = 0; i < m2.length; i++) {
                        cont++;
                        strValA += (m2[i] + '');
                        if (cont == 3 && i < m2.length - 1) {
                            strValA += ',';
                            cont = 0;
                        }
                    }
                    m2 = Array.from(strValA);
                    m2 = m2.reverse();
                    var textval = '';
                    for (var i = 0; i < m2.length; i++) {
                        textval += m2[i] + '';
                    }
                    return textval;
                }
            </script>

            <script>
                new WOW().init();
            </script>
            <script>
                fbq('track', 'AddToCart');
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

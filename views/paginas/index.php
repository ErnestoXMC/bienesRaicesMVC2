<!--Header-->
<main class="contenedor">
    <h1 class="titulo-regular">Más Sobre Nosotros</h1>

    <?php include 'iconos.php'; ?>

</main>

<!--Propiedades-->
<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>
    
    <?php include 'listado.php';?>
    
    <div class="alinear-derecha">
        <a href="/propiedades" class="btn-verde">Ver Propiedades</a>
    </div>
    
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se comunicara contigo lo más pronto posible</p>
    <a href="/contacto" class="btn-amarillo">Contáctanos</a>
</section><!--Seccion de contacto-->

<div class="seccion contenedor seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/entrada">
                    <h4 class="titulo-blog">Terraza en el techo de tu casa</h4>
                </a>
                <p class="informacion-meta">Escrito el: <span>13/07/2024</span> por <span>Admin</span></p>
                <p>Consejos para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando en dinero</p>
            </div>
        </article><!--entrada-blog-->

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/entrada">
                    <h4 class="titulo-blog">Guía para decorar tu hogar</h4>
                </a>
                <p class="informacion-meta">Escrito el: <span>13/07/2024</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
            </div>
        </article><!--entrada-blog-->

    </section><!--Blog-->

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis  espectativas
            </blockquote>
            <p>-Ernesto Manrique</p>
        </div>
    </section>

</div>
<!--Footer-->


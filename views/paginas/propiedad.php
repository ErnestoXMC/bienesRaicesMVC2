<!--Header-->
    <main class="contenedor seccion contenido-centrado">
        <h1 class="titulo-regular"><?php echo $propiedad->titulo ?></h1>
        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen propiedad">
        <div class="resumen-propiedad">
            <p>Precio: <span class="precio"> $<?php echo $propiedad->precio ?></span></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <p><?php echo $propiedad->wc ?></p>
                    <img src="build/img/icono_wc.svg" alt="Imagen wc" loading="lazy">
                </li>
                <li>
                    <p><?php echo $propiedad->habitaciones ?></p>
                    <img src="build/img/icono_estacionamiento.svg" alt="Imagen esta" loading="lazy">
                </li>
                <li>
                    <p><?php echo $propiedad->estacionamiento ?></p>
                    <img src="build/img/icono_dormitorio.svg" alt="Imagen dormi" loading="lazy">
                </li>
            </ul>
            <p>
                <?php echo $propiedad->descripcion ?>
            </p>
        </div>
    </main>
<!--Footer-->

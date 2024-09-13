<?php
    use App\Propiedad;
    
    if($_SERVER["SCRIPT_NAME"] === "/anuncios.php"){
        $propiedades = Propiedad::all();
    }else{
        $propiedades = Propiedad::getPropiedades(3);
    }

?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) {?>
        <div class="anuncio">
            <img src="../../imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" loading="lazy">
            <div class="contenido-anuncio">
                <h3><?php echo truncateText($propiedad->titulo, 20, true); ?></h3>
                <p><?php echo truncateText($propiedad->descripcion, 50, false); ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <p><?php echo $propiedad->wc; ?></p>
                        <img src="build/img/icono_wc.svg" alt="Imagen wc" loading="lazy">
                    </li>
                    <li>
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                        <img src="build/img/icono_estacionamiento.svg" alt="Imagen esta" loading="lazy">
                    </li>
                    <li>
                        <p><?php echo $propiedad->habitaciones; ?></p>
                        <img src="build/img/icono_dormitorio.svg" alt="Imagen dormi" loading="lazy">
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad->id;?>" class="btn-amarillo-block">Ver Propiedad</a>
            </div><!--Informacion-->
        </div><!--Anuncio-->
    <?php }?>
</div><!--.contenedor-anuncios-->
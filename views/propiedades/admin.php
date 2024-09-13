<!--Header-->
<main class="contenedor">
    <h1>Administrador</h1>
    <a href="/propiedades/crear" class="btn-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="btn-amarillo">Nuevo(a) Vendedor</a>
    <?php 
    $mensaje = mostrarNotificacion(intval($resultado));
    if($mensaje){ ?>
        <p class="alerta exito"><?php echo $mensaje;?></p>
    <?php }; ?>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Titulo</td>
                <td>Imagen</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($propiedades as $propiedad){?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="btn-amarillo-block width">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="btn-verde-block">Actualizar</a>

                    </td>
                </tr>
            <?php } ; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
            <table class="propiedades">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>telefono</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vendedores as $vendedor){?>
                        <tr>
                            <td><?php echo $vendedor->id; ?></td>
                            <td><?php echo $vendedor->nombre . " " . $vendedor->apellido ; ?></td>
                            <td><?php echo $vendedor->telefono; ?></td>
                            <td>
                                <form method="POST" class="w-100" action="/vendedores/eliminar">
                                    <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                    <input type="hidden" name="tipo" value="vendedor">
                                    <input type="submit" value="Eliminar" class="btn-amarillo-block width">
                                </form>
                                <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="btn-verde-block">Actualizar</a>
                            </td>
                        </tr>
                    <?php } ; ?>
                </tbody>
            </table>
</main>
<!--Footer-->

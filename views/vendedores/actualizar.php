<!--Header-->
<main class="contenedor">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/admin" class="btn-verde">Volver</a>
        <?php foreach($errores as $error){?>
            <div class="alerta error">
                <?php echo "$error";?>
            </div>
        <?php }?>
        
    <form method="POST" class="formulario">
        
        <?php include __DIR__ . '/formulario.php';?>

        <input type="submit" value="Actualizar Vendedor(a)" class="btn-verde">
    </form>
</main>
<!--Footer-->
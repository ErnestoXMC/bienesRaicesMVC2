
<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo sanitizar($vendedor->nombre) ;?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo sanitizar($vendedor->apellido) ;?>">
</fieldset>

<fieldset>
    <legend>Información Adicional</legend>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono Vendedor" value="<?php echo sanitizar($vendedor->telefono) ;?>">
</fieldset>

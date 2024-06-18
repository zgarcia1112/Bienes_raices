<fieldset>
    <legend>Informacion General</legend>
    <label for="nombre">nombre</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor" value="<?php echo sanitizarHtml($vendedor->nombre); ?>">


    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor" value="<?php echo sanitizarHtml($vendedor->apellido); ?>">


</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Telefono</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono vendedor" value="<?php echo sanitizarHtml($vendedor->telefono); ?>">


</fieldset>
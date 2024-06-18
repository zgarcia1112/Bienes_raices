<legend>Informacion General</legend>

<fieldset>
    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo sanitizarHtml($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="titulo" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizarHtml($propiedad->precio); ?>">

    <label for="imagen"> Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]" value="<?php echo '../../imagenes/' . $propiedad->imagen ?>">

    <?php if ($propiedad->imagen) { //si la imagen trae algo entra en la validacion 
    ?>
        <img src="<?php echo '../../imagenes/' . $propiedad->imagen; ?>" class='imagen-small'>
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]" placeholder="Descricion Propiedad"><?php echo sanitizarHtml($propiedad->descripcion); ?> </textarea>
</fieldset>
<fieldset>

    <legend>Informacion de la propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizarHtml($propiedad->habitaciones); ?>">

    <label for="wc">Banos:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizarHtml($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizarHtml($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendendor</label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option selected value=""> --Selecciona-- </option>
        <?php foreach ($vendedores as $vendedor) { ?>
            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo sanitizarHtml($vendedor->id) ?>"> <?php echo sanitizarHtml($vendedor->nombre) . " " . sanitizarHtml($vendedor->apellido); ?></option>
        <?php } ?>
    </select>
</fieldset>
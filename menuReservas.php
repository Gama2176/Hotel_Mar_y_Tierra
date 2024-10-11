<form action="./Controller/reservaciones.php" method="post">
    <?php
        // Recibir las variables del formulario anterior (hacerReserva)
        $idhabitacion = $_POST['idhabitacion'];
        $idusuario = $_POST['idusuario'];
    ?>
    
    <!-- Campos ocultos para pasar los datos de la habitación y el usuario -->
    <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion; ?>">
    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

    <label for="fecha_entrada">Fecha de llegada:</label>
    <input type="date" id="fecha_entrada" name="fecha_entrada" required><br>

    <label for="fecha_salida">Fecha de salida:</label>
    <input type="date" id="fecha_salida" name="fecha_salida" required><br>

    <input type="submit" name="btn_reservar" value="Reservar ahora">
</form>

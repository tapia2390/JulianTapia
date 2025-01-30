<div id="form-producto" class="formulario-bonito">
    <h3>Agregar Producto</h3>

    <div class="form-group">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
    </div>

    <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" required>
    </div>

    <div class="form-group">
        <label for="referencia">Referencia:</label>
        <input type="text" id="referencia" name="referencia" placeholder="Ingrese la referencia" required>
    </div>

    <div class="form-group">
        <label for="categoria">Categoría:</label>
        <div id="menu-items-select">
            <?php include 'path_to_php_script.php'; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="Ingrese el precio" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" placeholder="Ingrese una descripción" required cols="45" rows="6" style="resize: both;"></textarea>
    </div>

    <div class="form-group">
        <button onclick="guardarProducto()" class="btn">Guardar Producto</button>
    </div>
</div>

<!-- Modal para editar un producto -->
<div id="modal-editar-producto" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="cerrarModal()">×</span>
        <h3>Editar Producto</h3>
        <form id="form-editar-producto">
            <!-- Los campos de edición se llenarán dinámicamente -->
        </form>
    </div>
</div>
<!--div id="form-menu-items" class="formulario-bonito">
    <h3>Agregar ítems al menú</h3>

    <div class="form-group">
        <label for="nombre">Categoría:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese la categoría" required>
    </div>

    <div class="form-group">
        <button onclick="guardarItem()" class="btn">Guardar Ítem</button>
    </div>
</div-->
<div id="form-menu-items" class="formulario-bonito">
    <button onclick="guardarItem()" class="btn"> + </button>

    <h3>Lista de ítems</h3>
    <table id="tabla-menu-items">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los ítems serán cargados dinámicamente aquí -->
        </tbody>
    </table>
</div>



// Función para guardar el producto
function guardarProducto() {
    alert("guardar");
    const nombre = document.getElementById('nombre').value;
    const cantidad = document.getElementById('cantidad').value;
    const referencia = document.getElementById('referencia').value;
    const imagen = document.getElementById('imagen').files[0];
    const precio = document.getElementById('precio').value;
    const descripcion = document.getElementById('descripcion').value;

    if (!nombre || !cantidad || !referencia  || !imagen || !precio || !descripcion) {
        alert('Todos los campos son obligatorios');
        return;
    }
    
    const selectMenu = document.getElementById('menu-items-select');

    const selectedOption = selectMenu ? selectMenu.options[selectMenu.selectedIndex] : null;
 const selectedValue = "";
 const selectedText ="";
     // Verificamos que el select exista y que haya una opción seleccionada
     
    
    // Verificamos que el select exista y que haya una opción seleccionada
    if (selectMenu) {
         selectedValue = selectMenu.value; // Obtiene el ID de la opción seleccionada
         selectedText = selectMenu.options[selectMenu.selectedIndex]?.textContent || ''; // Obtiene el nombre de la opción seleccionada

        // Imprimir los valores seleccionados
        console.log("ID seleccionado:", selectedValue);
        console.log("Nombre seleccionado:", selectedText);

        if (selectedValue === "") {
            console.log("No se ha seleccionado ninguna opción.");
        }
    } else {
        console.error('El <select> no está disponible.');
    }
   

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('cantidad', cantidad);
    formData.append('referencia', referencia);
    formData.append('categoria', selectedText);
    formData.append('menu_item_id', selectedValue);
    formData.append('imagen', imagen);
    formData.append('precio', precio);
    formData.append('descripcion', descripcion);
    formData.append('action', "create");



    

    fetch('php/productos.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto guardado correctamente');
            location.reload();  // Recarga la página para mostrar el nuevo producto
        } else {
            alert('Error al guardar el producto');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Función para cargar los productos en la tabla
function cargarProductos() {
    
    fetch('php/productos.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'read' }),
        })  // Esto debería ser una llamada a un archivo PHP que devuelva los productos
        .then(response => response.json())
        .then(data => {
            const tablaProductos = document.getElementById('tabla-productos').getElementsByTagName('tbody')[0];
            data.forEach(producto => {
                const row = tablaProductos.insertRow();
                row.innerHTML = `
                    <td>${producto.nombre}</td>
                    <td>${producto.cantidad}</td>
                    <td>${producto.precio}</td>
                    <td><button onclick="editarProducto(${producto.id})">Editar</button></td>
                    <td><button onclick="eliminarProducto(${producto.id})">Eliminar</button></td>
                `;
            });
        })
        .catch(error => console.error('Error:', error));
}

// Función para abrir el modal de edición
function editarProducto(id) {
    fetch(`getProducto.php?id=${id}`)
        .then(response => response.json())
        .then(producto => {
            // Llenar los campos del modal con los datos del producto
            const formEditar = document.getElementById('form-editar-producto');
            formEditar.innerHTML = `
                <input type="text" id="nombre-editar" value="${producto.nombre}" required>
                <input type="number" id="cantidad-editar" value="${producto.cantidad}" required>
                <input type="text" id="referencia-editar" value="${producto.referencia}" required>
                <input type="number" id="precio-editar" value="${producto.precio}" required>
                <textarea id="descripcion-editar" required>${producto.descripcion}</textarea>
                <button onclick="guardarEdicion(${producto.id})">Guardar Cambios</button>
            `;
            document.getElementById('modal-editar-producto').style.display = 'block';
        });
}

// Función para guardar la edición del producto
function guardarEdicion(id) {
    const nombre = document.getElementById('nombre-editar').value;
    const cantidad = document.getElementById('cantidad-editar').value;
    const referencia = document.getElementById('referencia-editar').value;
    const precio = document.getElementById('precio-editar').value;
    const descripcion = document.getElementById('descripcion-editar').value;

    fetch('php/productos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: id,
            nombre: nombre,
            cantidad: cantidad,
            referencia: referencia,
            precio: precio,
            descripcion: descripcion,
            action: "update"
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto actualizado');
            location.reload();
        }
    });
}

// Función para eliminar un producto
function eliminarProducto(id) {
    if (confirm('¿Está seguro de eliminar este producto?')) {
        fetch('eliminarProducto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({action: "delete", id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Producto eliminado');
                location.reload();
            }
        });
    }
}

// Función para cerrar el modal de edición
function cerrarModal() {
    document.getElementById('modal-editar-producto').style.display = 'none';
}


//***select menu */
document.addEventListener('DOMContentLoaded', function() {
    // Consultar los items del menú a través de PHP
    fetch('php/crud_item_menu.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'read' }) // Enviar la acción al PHP
    })
    .then(response => response.json()) // Convertir la respuesta JSON
    .then(data => {
        // Verificar si los datos se recibieron correctamente
        if (data.success && Array.isArray(data.data) && data.data.length > 0) {
            // Crear el <select> dinámicamente
            const selectMenu = document.createElement('select');
            selectMenu.id = "menu_item_id";
            selectMenu.name = "menu_item_id";
            selectMenu.required = true;

            // Crear la opción por defecto
            const optionDefault = document.createElement('option');
            optionDefault.value = "";
            optionDefault.textContent = "Seleccione una categoría";
            selectMenu.appendChild(optionDefault);

            // Agregar las opciones de los ítems del menú
            data.data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;       // Asignar el ID como value
                option.textContent = item.categoria; // Asignar el nombre como texto
                selectMenu.appendChild(option);
            });

            // Agregar el <select> al contenedor
            const menuItemsSelectContainer = document.getElementById('menu-items-select');
            if (menuItemsSelectContainer) {
                menuItemsSelectContainer.appendChild(selectMenu);
            } else {
                console.error("Contenedor de ítems no encontrado.");
            }
        } else {
            console.error('No se encontraron ítems en el menú o el formato de los datos no es correcto.');
        }
    })
    .catch(error => {
        console.error('Error al obtener los items:', error);
    });
});
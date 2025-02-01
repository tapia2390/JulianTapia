let editandoProducto = null;

// Función para guardar el producto
function guardarProducto() {
  let action = "";
  let rutaImg = "";
  let id = "";

  const nombre = document.getElementById("nombre").value;
  const cantidad = document.getElementById("cantidad").value;
  const referencia = document.getElementById("referencia").value;
  const imagen = document.getElementById("imagen").files[0];
  const precio = document.getElementById("precio").value;
  const descripcion = document.getElementById("descripcion").value;

  if (!nombre || !cantidad || !referencia || !precio || !descripcion) {
    alert("Todos los campos son obligatorios");
    return;
  }

  const selectMenu = document.getElementById("menu_item_id");

  // Verificar si el selectMenu existe en el DOM
  let selectedValue = "";
  let selectedText = "";
  if (selectMenu) {
    // Obtener el valor (ID de la opción seleccionada)
    selectedValue = selectMenu.value;

    // Obtener el texto (nombre de la opción seleccionada)
    selectedText = selectMenu.options[selectMenu.selectedIndex].textContent;
  } else {
    // Si no se encuentra el select con ese ID
    console.error('El select con ID "menu_item_id" no fue encontrado.');
  }

  const formData = new FormData();
  if (editandoProducto) {
    alert(editandoProducto);
    rutaImg = editandoProducto.imagen;
    id = editandoProducto.id;

    formData.append("id", id);
    formData.append("rutaImg", rutaImg);

    action = "update";
  } else {
    action = "create";
    alert(action);
    formData.append("rutaImg", "");
  }
  formData.append("nombre", nombre);
  formData.append("cantidad", cantidad);
  formData.append("referencia", referencia);
  formData.append("categoria", selectedText);
  formData.append("menu_item_id", selectedValue);
  formData.append("imagen", imagen);
  formData.append("precio", precio);
  formData.append("descripcion", descripcion);
  formData.append("action", action);

  fetch("php/crud_producto.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Producto guardado correctamente" + data.success);
        //location.reload(); // Recarga la página para mostrar el nuevo producto
      } else {
        alert("Error al guardar el producto");
      }
    })
    .catch((error) => console.error("Error:", error));
}

// Función para abrir el modal de edición
function editarProducto(id) {
  fetch(`getProducto.php?id=${id}`)
    .then((response) => response.json())
    .then((producto) => {
      // Llenar los campos del modal con los datos del producto
      const formEditar = document.getElementById("form-editar-producto");
      formEditar.innerHTML = `
                <input type="text" id="nombre-editar" value="${producto.nombre}" required>
                <input type="number" id="cantidad-editar" value="${producto.cantidad}" required>
                <input type="text" id="referencia-editar" value="${producto.referencia}" required>
                <input type="number" id="precio-editar" value="${producto.precio}" required>
                <textarea id="descripcion-editar" required>${producto.descripcion}</textarea>
                <button onclick="guardarEdicion(${producto.id})">Guardar Cambios</button>
            `;
      document.getElementById("modal-editar-producto").style.display = "block";
    });
}

// Función para guardar la edición del producto
function guardarEdicion(id) {
  const nombre = document.getElementById("nombre-editar").value;
  const cantidad = document.getElementById("cantidad-editar").value;
  const referencia = document.getElementById("referencia-editar").value;
  const precio = document.getElementById("precio-editar").value;
  const descripcion = document.getElementById("descripcion-editar").value;

  fetch("php/productos.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      id: id,
      nombre: nombre,
      cantidad: cantidad,
      referencia: referencia,
      precio: precio,
      descripcion: descripcion,
      action: "update",
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Producto actualizado");
        location.reload();
      }
    });
}

// Función para eliminar un producto
function eliminarProducto(id) {
  const formData = new FormData();
  formData.append("id", id);
  formData.append("action", "delete");
  if (confirm("¿Está seguro de eliminar este producto?")) {
    fetch("php/crud_producto.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Producto eliminado");
          location.reload();
        }
      });
  }
}

/*****Modal*** */

/*function abrirModal() {
  document.getElementById("modal-producto").style.display = "flex";
}*/

function abrirModal(producto = null) {
  editandoProducto = producto;

  let modal = document.getElementById("modal-producto");
  modal.style.display = "flex";

  if (producto) {
    document.getElementById("nombre").value = producto.nombre;
    document.getElementById("cantidad").value = producto.cantidad;
    document.getElementById("referencia").value = producto.referencia;
    document.getElementById("precio").value = producto.precio;
    document.getElementById("descripcion").value = producto.descripcion;

    // Cargar la opción guardada en el select
    document.getElementById("menu_item_id").value = producto.menu_item_id;

    document.querySelector("#modal-producto h3").innerText = "Editar Producto";
  } else {
    document.getElementById("nombre").value = "";
    document.getElementById("cantidad").value = "";
    document.getElementById("referencia").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("descripcion").value = "";

    // Cargar la opción guardada en el select
    document.getElementById("menu_item_id").value = 0;
    document.querySelector("#modal-producto h3").innerText = "Agregar Producto";
  }
}

// Función para cerrar el modal
function cerrarModal() {
  document.getElementById("modal-producto").style.display = "none";
  editandoProducto = null;
}

// Cerrar modal si se hace clic fuera de él
window.onclick = function (event) {
  let modal = document.getElementById("modal-producto");
  if (event.target === modal) {
    cerrarModal();
  }
};

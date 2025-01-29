const botonesCategorias = document.querySelectorAll(".boton-categoria");
botonesCategorias.forEach(boton => {
    boton.addEventListener("click", (e) => {

        botonesCategorias.forEach(boton => boton.classList.remove("active"));
        e.currentTarget.classList.add("active");

    })
});


// Cargar lista de formulario
document.addEventListener("DOMContentLoaded", () => {
    const contenedorForm = document.getElementById("contenedor-form");
    const botonesMenu = document.querySelectorAll(".boton-categoria");

    botonesMenu.forEach((boton) => {
        boton.addEventListener("click", () => {
            const categoria = boton.id; // El ID del botón coincide con el formulario
            cargarFormulario(categoria);
        });
    });

    function cargarFormulario(categoria) {
        fetch(`admin/${categoria}_form.php`) // Ruta dinámica al formulario
            .then((response) => response.text())
            .then((html) => {
                contenedorForm.innerHTML = html; // Cargar el formulario
                if(categoria=="menu_items"){
                    listarItems();
                }
            })
            .catch((err) => console.error("Error al cargar el formulario:", err));
            
    }

    cargarFormulario("productos"); 
    
    
    // CRUD: Guardar ítem
    async function guardarItem() {
        //const categoria  = document.getElementById("nombre").value.trim();

        /*if (!categoria ) {
            alert("El campo Nombre es obligatorio.");
            return;
        }*/

         const categoria = prompt("Ingrese el nuevo nombre del ítem del menu:");
        if (!categoria) return alert("El nombre no puede estar vacío.");

        

        try {
            const response = await fetch("php/crud_item_menu.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ action: "create", categoria  }),
            });

            const result = await response.json();

            if (result.success) {
                alert("Ítem guardado con éxito.");
                listarItems(); // Actualizar la lista
            } else {
                alert(`Error: ${result.message}`);
            }
        } catch (error) {
           //console.error("Error al guardar el ítem:", error);
            alert("Ocurrió un error al guardar el ítem.");
        }
    }

    // CRUD: Listar ítems
    async function listarItems() {
    try {
        const response = await fetch('php/crud_item_menu.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'read' }),
        });

        const result = await response.json();
        const items = result.data;
       
        const tabla = document.getElementById('tabla-menu-items').getElementsByTagName('tbody')[0];
        tabla.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos ítems

        items.forEach(item => {
            const row = tabla.insertRow();
            const cellCategoria = row.insertCell(0);
            const cellAcciones = row.insertCell(1);

            cellCategoria.textContent = item.categoria;

            



            // Crear botones de editar y eliminar
            const btnEditar = document.createElement('button');            
            btnEditar.innerHTML = '<i class="bi bi-pencil"></i>'; 
            btnEditar.onclick = () => editarItem(item.id);

            const btnEliminar = document.createElement('button');
            btnEliminar.innerHTML = '<i class="bi bi-trash"></i>'; // Icono de eliminar
            btnEliminar.onclick = () => eliminarItem(item.id);

            btnEditar.classList.add('btn', 'btn-primary'); // Estilo para el botón de editar
            btnEliminar.classList.add('btn', 'btn-danger'); // Estilo para el botón de eliminar

            cellAcciones.appendChild(btnEditar);
            cellAcciones.appendChild(btnEliminar);
        });
    } catch (error) {
        console.error('Error al listar los ítems:', error);
    }
}


    // CRUD: Editar ítem
    async function editarItem(id) {
        const nuevoNombre = prompt("Ingrese el nuevo nombre del ítem:");
        if (!nuevoNombre) return alert("El nombre no puede estar vacío.");

        try {
            const response = await fetch("php/crud_item_menu.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ action: "update", id, nombre: nuevoNombre }),
            });

            const result = await response.json();

            if (result.success) {
                alert("Ítem actualizado con éxito.");
                listarItems();
            } else {
                alert(`Error: ${result.message}`);
            }
        } catch (error) {
            console.error("Error al editar el ítem:", error);
        }
    }

    // CRUD: Eliminar ítem
    async function eliminarItem(id) {
        if (!confirm("¿Estás seguro de eliminar este ítem?")) return;

        try {
            const response = await fetch("php/crud_item_menu.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ action: "delete", id }),
            });

            const result = await response.json();

            if (result.success) {
                alert("Ítem eliminado con éxito.");
                listarItems();
            } else {
                alert(`Error: ${result.message}`);
            }
        } catch (error) {
            console.error("Error al eliminar el ítem:", error);
        }
    }

    // Inicializar listado
   // listarItems();

    // Exportar la función para que se pueda usar en el botón Guardar
    window.guardarItem = guardarItem;
});

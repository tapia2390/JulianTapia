

//cargar lista de formaulario

document.addEventListener("DOMContentLoaded", () => {
    const contenedorForm = document.getElementById("contenedor-form");
    const botonesMenu = document.querySelectorAll(".boton-categoria");

    botonesMenu.forEach(boton => {
        boton.addEventListener("click", () => {
           
            const categoria = boton.id; // El ID del botón coincide con el formulario
            cargarFormulario(categoria);
        });
    });

    function cargarFormulario(categoria) {
         alert("ok"+categoria);
        fetch(`admin/${categoria}_form.php`) // Ruta dinámica al formulario
            .then(response => response.text())
            .then(html => {
                contenedorForm.innerHTML = html; // Cargar el formulario
            })
            .catch(err => console.error("Error al cargar el formulario:", err));
    }
});



//crud 
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-menu-items");

    // Validar y enviar formulario
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const nombre = document.getElementById("nombre").value.trim();

        // Validar campo vacío
        if (!nombre) {
            alert("El campo Nombre es obligatorio.");
            return;
        }

        // Llamar a la función para guardar el dato
        await guardarItem(nombre);
    });

    // CRUD: Guardar ítem
    async function guardarItem(nombre) {
        try {
            const response = await fetch("php/guardar_item.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ nombre }),
            });

            const result = await response.json();

            if (result.success) {
                alert("Ítem guardado con éxito.");
                form.reset();
                listarItems(); // Actualizar la lista
            } else {
                alert(`Error: ${result.message}`);
            }
        } catch (error) {
            console.error("Error al guardar el ítem:", error);
            alert("Ocurrió un error al guardar el ítem.");
        }
    }

    // CRUD: Listar ítems
    async function listarItems() {
        try {
            const response = await fetch("php/listar_items.php");
            const items = await response.json();

            const contenedorForm = document.getElementById("contenedor-form");
            contenedorForm.innerHTML = `
                <ul class="lista-items">
                    ${items
                        .map(
                            (item) => `
                        <li>
                            ${item.nombre}
                            <button class="btn-editar" data-id="${item.id}">Editar</button>
                            <button class="btn-eliminar" data-id="${item.id}">Eliminar</button>
                        </li>
                    `
                        )
                        .join("")}
                </ul>
            `;

            // Asociar eventos a botones
            document.querySelectorAll(".btn-editar").forEach((btn) =>
                btn.addEventListener("click", (e) => editarItem(e.target.dataset.id))
            );
            document.querySelectorAll(".btn-eliminar").forEach((btn) =>
                btn.addEventListener("click", (e) => eliminarItem(e.target.dataset.id))
            );
        } catch (error) {
            console.error("Error al listar ítems:", error);
        }
    }

    // CRUD: Editar ítem
    async function editarItem(id) {
        const nuevoNombre = prompt("Ingrese el nuevo nombre del ítem:");
        if (!nuevoNombre) return alert("El nombre no puede estar vacío.");

        try {
            const response = await fetch("php/editar_item.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id, nombre: nuevoNombre }),
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
            const response = await fetch("php/eliminar_item.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id }),
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
    listarItems();
});

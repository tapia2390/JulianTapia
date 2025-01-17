

 // Recuperar el producto seleccionado desde LocalStorage
        const productoDetalle = JSON.parse(localStorage.getItem("producto-detalle"));
        const detalleContenedor = document.getElementById("contenedor-detalle");
        const tablaHistorial = document.createElement("table"); // Para almacenar el historial de ventas
        tablaHistorial.innerHTML = `<thead><tr><th>Fecha</th><th>Producto</th><th>Id</th><th>Cantidad</th><th>Total</th></tr></thead><tbody></tbody>`;
        document.body.appendChild(tablaHistorial);


// Verificar si hay datos en LocalStorage
if (productoDetalle) {
    detalleContenedor.innerHTML = `
          <div class="producto-detalle">
            <img src="${productoDetalle.imagen}" alt="${productoDetalle.titulo}" class="producto-imagen2">
            <div class="producto-detalles2">
                <h1>${productoDetalle.titulo}</h1>
               <p>Inventario disponible: <span id="inventario">${productoDetalle.cantidad}</span></p>
                <p>Precio: $${new Intl.NumberFormat('es-ES').format(productoDetalle.precio)}</p>
                <p>Referencia: ${productoDetalle.referencia}.</p>
                <p>Descripción: ${productoDetalle.descripcion}.</p>
                  
                <p>
                    Cantidad: 
                    <input type="number" id="cantidad" min="1" value="1"/>
                </p>
                <p id="totalproducto">Total a pagar: $${new Intl.NumberFormat('es-ES').format(productoDetalle.precio)}</p>

                <div>
                    <p>Observaciones: </p><textarea id="observaciones" rows="10" cols="50" placeholder="observaciones...."></textarea>     
                </div>
                <button class="producto-agregar2 vender" id="${productoDetalle.id}">Vender</button>
            </div>
        </div>
        



    `;
  // Calcular y actualizar el total dinámicamente

      const inputCantidad = document.getElementById("cantidad");
      const totalProducto = document.getElementById("totalproducto");
      const inventarioSpan = document.getElementById("inventario");

  inputCantidad.addEventListener("input", () => {
    const cantidad = parseInt(inputCantidad.value) || 0;
    if (cantidad > 0) {
        const total = cantidad * productoDetalle.precio;
        totalProducto.innerHTML = `Total a pagar: $${new Intl.NumberFormat('es-ES').format(total)}`;
    } else {
        totalProducto.innerHTML = "Total a pagar: $0";
    }
});

   
      // Confirmación y registro de venta
            document.querySelector(".vender").addEventListener("click", () => {
                const cantidadSolicitada = parseInt(inputCantidad.value) || 0;
                const cantidadDisponible = productoDetalle.cantidad;

                // Validar si la cantidad solicitada está disponible en el stock
                if (cantidadSolicitada <= 0) {
                    alert("Por favor, ingresa una cantidad válida.");
                    return;
                }

                if (cantidadSolicitada > cantidadDisponible) {
                    alert(`No hay suficiente stock. Disponibles: ${cantidadDisponible}`);
                    return;
                }

                // Confirmación de venta
                const confirmacion = confirm(`¿Confirmas la venta de ${cantidadSolicitada} ${productoDetalle.titulo}?`);
                if (!confirmacion) {
                    return;
                }

                // Descontar el stock y actualizar LocalStorage
                productoDetalle.cantidad -= cantidadSolicitada;
                localStorage.setItem("producto-detalle", JSON.stringify(productoDetalle));

                // Registrar venta en el historial
                const totalVenta = cantidadSolicitada * productoDetalle.precio;
                const fecha = new Date().toLocaleString();

                const fila = document.createElement("tr");
                fila.innerHTML = `
                    <td>${fecha}</td>
                    <td>${productoDetalle.titulo}</td>
                    <td>${productoDetalle.id}</td>
                    <td>${cantidadSolicitada}</td>
                    <td>$${new Intl.NumberFormat('es-ES').format(totalVenta)}</td>
                `;
                tablaHistorial.appendChild(fila);

                // Mostrar mensaje de éxito
                Toastify({
                    text: "Venta realizada con éxito",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #4b33a8, #785ce9)",
                        borderRadius: "2rem",
                        textTransform: "uppercase",
                        fontSize: ".75rem"
                    }
                }).showToast();

                // Actualizar UI
                inputCantidad.value = "1";
                totalProducto.textContent = `Total a pagar: $${new Intl.NumberFormat('es-ES').format(productoDetalle.precio)}`;
                inventarioSpan.textContent = productoDetalle.cantidad;
            });
} else {
    detalleContenedor.innerHTML = "<p>No hay información del producto para mostrar.</p>";
}




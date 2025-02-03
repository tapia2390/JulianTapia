// Recuperar el producto seleccionado desde LocalStorage
const productoDetalle = JSON.parse(localStorage.getItem("producto-detalle"));
const detalleContenedor = document.getElementById("contenedor-detalle");
let botonesAgregar = document.querySelectorAll(".producto-agregar");

document.addEventListener("DOMContentLoaded", function () {
  actualizarBotonesAgregar();
});

// Verificar si hay datos en LocalStorage
if (productoDetalle) {
  detalleContenedor.innerHTML = `
          <div class="producto-detalle">
            <img  class="imgdetalle" src="${productoDetalle.imagen}" alt="${
    productoDetalle.titulo
  }" class="producto-imagen2">
            <div class="producto-detalles2">
                <h1>${productoDetalle.titulo}</h1>
               <p>Inventario disponible: <span id="inventario">${
                 productoDetalle.cantidad
               }</span></p>
                <p>Precio: $${new Intl.NumberFormat("es-ES").format(
                  productoDetalle.precio
                )}</p>
                <p>Referencia: ${productoDetalle.referencia}.</p>
                <p>Descripción: ${productoDetalle.descripcion}.</p>
                <p>
                    Cantidad: 
                    <input type="number" id="cantidad" min="1" value="1"/>
                </p>
                <p id="totalproducto">Total a pagar: $${new Intl.NumberFormat(
                  "es-ES"
                ).format(productoDetalle.precio)}</p>
                <div>
                    <p>Observaciones: </p><textarea id="observaciones" rows="10" cols="50" placeholder="observaciones...." style="resize: both;"></textarea>     
                </div>
              <div class="botones-container">
                  <button class="producto-agregar producto-detalle-btn" id="${
                    productoDetalle.id
                  }">  <i class="bi bi-cart-plus"></i></button>
                <!-- Botón de WhatsApp -->
                  <button class="whatsapp-button producto-agregar-btn" id="btn-whatsapp">
                  <img src="https://cdn-icons-png.flaticon.com/512/220/220236.png" width="20px" alt="WhatsApp"> 
                  </button>
              </div>
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
      totalProducto.innerHTML = `Total a pagar: $${new Intl.NumberFormat(
        "es-ES"
      ).format(total)}`;
    } else {
      totalProducto.innerHTML = "Total a pagar: $0";
    }
  });

  document.querySelector(".whatsapp-button").addEventListener("click", () => {
    const cantidadSolicitada = parseInt(inputCantidad.value) || 1;
    const totalPagar = cantidadSolicitada * productoDetalle.precio;
    const observaciones = document.getElementById("observaciones").value;

    // Mensaje de WhatsApp
    const mensaje = `Hola, estoy interesado en el siguiente producto:
🔹 *${productoDetalle.titulo}*
📌 Referencia: ${productoDetalle.referencia}
📦 Cantidad: ${cantidadSolicitada}
💰 Precio unitario: $${new Intl.NumberFormat("es-ES").format(
      productoDetalle.precio
    )}
💵 Total a pagar: $${new Intl.NumberFormat("es-ES").format(totalPagar)}
📝 Observaciones: ${observaciones ? observaciones : "Ninguna"}

¿Está disponible?`;

    // Número de WhatsApp (ejemplo: +573001234567)
    const numeroWhatsApp = "573146381721";
    const url = `https://api.whatsapp.com/send?phone=${numeroWhatsApp}&text=${encodeURIComponent(
      mensaje
    )}`;

    // Abrir WhatsApp en nueva pestaña
    window.open(url, "_blank");
  });

  // Confirmación y registro de venta
  /*document.querySelector(".vender").addEventListener("click", () => {
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
    const confirmacion = confirm(
      `¿Confirmas la venta de ${cantidadSolicitada} ${productoDetalle.titulo}?`
    );
    if (!confirmacion) {
      return;
    }

    // Enviar solicitud AJAX para validar stock y registrar la venta
    fetch("php/venta.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        producto_id: productoDetalle.id,
        cantidad: cantidadSolicitada,
        total: cantidadSolicitada * productoDetalle.precio,
        observaciones: document.getElementById("observaciones").value,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
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
              fontSize: ".75rem",
            },
          }).showToast();

          // Actualizar UI
          inputCantidad.value = "1";
          totalProducto.textContent = `Total a pagar: $${new Intl.NumberFormat(
            "es-ES"
          ).format(productoDetalle.precio)}`;
          inventarioSpan.textContent =
            productoDetalle.cantidad - cantidadSolicitada;
          alert(productoDetalle.cantidad + "cantidad");
        } else {
          alert(data.message); // Mostrar el mensaje del servidor (si hay error)
        }
      })
      .catch((error) => console.error("Error:", error));
  });*/
} else {
  detalleContenedor.innerHTML =
    "<p>No hay información del producto para mostrar.</p>";
}

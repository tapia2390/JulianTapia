// Función para obtener las ventas por producto
function obtenerVentas() {
  const productoId = document.getElementById("producto_id").value;

  if (!productoId) {
    alert("Por favor, ingresa un ID de producto");
    return;
  }

  fetch(`php/venta.php?producto_id=${productoId}`)
    .then((response) => response.json())
    .then((data) => {
      const ventasTabla = document
        .getElementById("ventasTabla")
        .getElementsByTagName("tbody")[0];
      ventasTabla.innerHTML = ""; // Limpiar la tabla antes de llenarla con los resultados

      if (data.length === 0) {
        ventasTabla.innerHTML =
          '<tr><td colspan="6">No hay ventas para este producto.</td></tr>';
      } else {
        data.forEach((venta) => {
          let row = ventasTabla.insertRow();
          row.innerHTML = `
                                <td>${venta.id}</td>
                                <td>${venta.fecha}</td>
                                <td>${venta.producto_nombre}</td>
                                <td>${venta.cantidad}</td>
                                <td>${venta.total}</td>
                                <td>${venta.observaciones}</td>
                            `;
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

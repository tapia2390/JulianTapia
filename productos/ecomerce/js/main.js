const contenedorProductos = document.querySelector("#contenedor-productos");
const botonesCategorias = document.querySelectorAll(".boton-categoria");
const tituloPrincipal = document.querySelector("#titulo-principal");
let botonesAgregar = document.querySelectorAll(".producto-agregar");
const numerito = document.querySelector("#numerito");

botonesCategorias.forEach((boton) =>
  boton.addEventListener("click", () => {
    aside.classList.remove("aside-visible");
  })
);

function cargarProductos(productosElegidos) {
  contenedorProductos.innerHTML = "";

  productosElegidos.forEach((producto) => {
    //console.log(JSON.stringify(producto));
    const precioFormateado = new Intl.NumberFormat("es-ES").format(
      producto.precio
    );

    const div = document.createElement("div");
    div.classList.add("producto");
    div.innerHTML = `
        <div>
           <img class="producto-imagen" src="${producto.imagen}" alt="${producto.titulo}">
        <div class="producto-detalles">
            <h3 class="producto-titulo">${producto.titulo}</h3>

            <div class="fila">
               <p class="producto-precio">$${precioFormateado}</p>
               <p> Cantidad: ${producto.cantidad}</p>
              
            </div>
            
           
          

            <div class="botones-container">
            <button class="producto-detalle producto-detalle-btn" id="${producto.id}">
               <i class="bi bi-info-circle"></i>
            </button>
            <button class="producto-agregar producto-agregar-btn" id="${producto.id}">
                 <i class="bi bi-cart-plus"></i>
            </button>
        </div>

        </div>
        
        </div>
       
        `;

    contenedorProductos.append(div);
  });

  actualizarBotonesAgregar();
  detalleproducto();
}

botonesCategorias.forEach((boton) => {
  boton.addEventListener("click", (e) => {
    botonesCategorias.forEach((boton) => boton.classList.remove("active"));
    e.currentTarget.classList.add("active");

    if (e.currentTarget.id != "todos") {
      //console.log(JSON.stringify(productos));
      const productoCategoria = productos.find(
        (producto) => producto.menu.toLowerCase() === e.currentTarget.id
      );

      tituloPrincipal.innerText = productoCategoria.menu;
      const productosBoton = productos.filter(
        (producto) => producto.menu.toLowerCase() === e.currentTarget.id
      );
      cargarProductos(productosBoton);
    } else {
      tituloPrincipal.innerText = "Todos los productos";
      cargarProductos(productos);
    }
  });
});

function detalleproducto() {
  botonesAgregar = document.querySelectorAll(".producto-detalle");

  botonesAgregar.forEach((boton) => {
    boton.addEventListener("click", productodetalle);
  });
}

function productodetalle(e) {
  const idBoton = e.currentTarget.id;
  const productoSeleccionado = productos.find(
    (producto) => producto.id === idBoton
  );

  // Guardar el producto en LocalStorage
  localStorage.setItem(
    "producto-detalle",
    JSON.stringify(productoSeleccionado)
  );

  // Redirigir a la página de detalles
  window.location.href = "detalle.php";
}

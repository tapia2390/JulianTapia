
function guardarDatos() {

  alert("response");
    var placa = document.getElementById('placa').value.trim();
    var descripcion = document.getElementById('descripcion').value.trim();
    var cascos = document.getElementById('cascos').value.trim();

    if (placa === "" || cascos === "") {
        alert("la placa o los cascos no estan registrados...");
    } else {

        // Crear objeto con datos a enviar
        var datos = {
            placa: placa,
            descripcion: descripcion,
            cascos: cascos
        };

        
      $.ajax({
        // Action
        url: 'addnew.php',
        // Method
        type: 'POST',
        data: {
          // Get value
          placa: $("input[name=placa]").val(),
          descripcion: $("input[name=descripcion]").val(),
          cascos: $("input[name=cascos]").val()
        },
        success:function(response){
          
          alert("response"+response);
          // Response is the output of action file
          if(response == 1){
            imprimirRecibo(placa,descripcion,cascos);
          }
          
          else{
            alert("error");
          }
        }
      });

    }
}

function imprimirRecibo(placa,descripcion,cascos) {
 

   
var ventanaImpresion = window.open('', '_self');
ventanaImpresion.document.write('<html><head><title>Parqueadero liborio lopera</title>');
ventanaImpresion.document.write('<style>@page { size: 48mm 95m; margin: 0; }</style>'); // Configurar el tamaño de la página para una impresora térmica de 80mm de ancho
ventanaImpresion.document.write('</head><body>');
ventanaImpresion.document.write('<h4><center>************ <br/>Parqueadero <br/> liborio lopera <br/>  ************</h4><h2><center>Placa: <strong style="color:blue;">'+placa+'</strong></center></h2><h3><center>Cascos: <strong>'+cascos+'</strong></center></h3><h3><center>Descripción: <strong>'+descripcion+'</strong></center></h3><h5><center> <b> NOTA: </b> No se responde por objetosdejados en las motos, ni se responde por cascos que estén sin marcar. <br/> Si se pierde este recibo solo con la tarjeta de propiedad del vehículo podrá reclamar. <br/> Horario: de Lunes a Sabado de 7:00 AM a 9:00 PM <br/> Cel: 310-000-000 </center></h5>');
ventanaImpresion.document.write('</body></html>');
ventanaImpresion.document.close();

ventanaImpresion.onafterprint = function () {
    window.location.reload(); // Recargar la página después de imprimir
};
ventanaImpresion.print();


}



function saveingresos(){
  
  var valor = document.getElementById('valor').value.trim();
  var descripcion = document.getElementById('descripcion').value.trim();

  if (valor === "" || descripcion === "") {
      alert("la descripcion o el valor no estan digitados");
  } else {

    var valorSinPunto = valor.replace(/\./g, "");
      // Crear objeto con datos a enviar
      var datos = {
        valor: valor,
          descripcion: descripcion
      };

      
    $.ajax({
      // Action
      url: 'php/addIngresos.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        valor: valorSinPunto,
        descripcion: $("input[name=descripcion]").val()
      },
      success:function(response){
        
        // Response is the output of action file
        if(response == 1){
          location.reload();
        }
        
        else{
          alert("error");
        }
      }
    });

  }
}


function saveegresos(){
  
  var valor = document.getElementById('valor').value.trim();
  var descripcion = document.getElementById('descripcion').value.trim();

  
  if (valor === "" || descripcion === "") {
      alert("la descripcion o el valor no estan digitados");
  } else {
    var valorSinPunto = valor.replace(/\./g, "");

      // Crear objeto con datos a enviar
      var datos = {
        valor: valor,
          descripcion: descripcion
      };

      
    $.ajax({
      // Action
      url: 'php/addEgresos.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        valor: valorSinPunto,
        descripcion: $("input[name=descripcion]").val()
      },
      success:function(response){
        
        // Response is the output of action file
        if(response == 1){
          location.reload();
        }
        
        else{
          alert("error");
        }
      }
    });

  }
}




//funcion formato de miles
function integerFormatIndistinto(e) {
   
  // Obtener el valor del input
  var numeroInput = document.getElementById('valor').value;

  // Remover cualquier caracter que no sea un dígito
  var numero = parseFloat(numeroInput.replace(/[^\d]/g, ''));

  // Verificar si es un número válido
  if (!isNaN(numero)) {
      // Formatear el número con separador de miles a partir del cuarto dígito
      var numeroFormateado = numero.toLocaleString(undefined, {
          minimumFractionDigits: 0,
          maximumFractionDigits: 20,
          useGrouping: true
      });

      document.getElementById('valor').textContent = numeroFormateado;

      // Actualizar el valor del input con el formato
      document.getElementById('valor').value = numeroFormateado;
  } else {
      // Si no es un número válido, mostrar un mensaje de error
      document.getElementById('valor').textContent = 'Ingrese un número válido';
  }
}



window.onload = function() {
  //SE EJECUTA DESPUES CARGAR EL CODIGO CSS y HTML
  // Creamos el evento keyup
  document.querySelectorAll(".valor").forEach(el => el.addEventListener("keyup", integerFormatIndistinto));
  };







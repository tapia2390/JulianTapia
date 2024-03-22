
function guardarDatos() {

  
    var placa = document.getElementById('placa').value.trim();
    var descripcion = document.getElementById('descripcion').value.trim();
    var cascos = document.getElementById('cascos').value.trim();
    var ubicacion =  document.getElementById('ubicacion').value.trim();

    if (placa === "" || cascos === "") {
        alert("la placa o los cascos no estan registrados...");
    } else {

        // Crear objeto con datos a enviar
        var datos = {
            placa: placa,
            descripcion: descripcion,
            cascos: cascos,
            ubicacion:ubicacion
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
          cascos: $("input[name=cascos]").val(),
          ubicacion: $("input[name=ubicacion]").val(),
        },
        success:function(response){
          
          //alert("response"+response);
          // Response is the output of action file
          if(response == 1){
            imprimirRecibo(placa,descripcion,cascos);
          }
          
          else{
            alert(response);
          }
        }
      });

    }
}


function guardarDatosLavadas() {

  
  var placa = document.getElementById('placa').value.trim();
  var descripcion = document.getElementById('descripcion').value.trim();
  var cascos = document.getElementById('cascos').value.trim();
  var ubicacion =  document.getElementById('ubicacion').value.trim();

  if (placa === "" || cascos === "") {
      alert("la placa o los cascos no estan registrados...");
  } else {

      // Crear objeto con datos a enviar
      var datos = {
          placa: placa,
          descripcion: descripcion,
          cascos: cascos,
          ubicacion:ubicacion
      };

      
    $.ajax({
      // Action
      url: 'addnewlavadas.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        placa: $("input[name=placa]").val(),
        descripcion: $("input[name=descripcion]").val(),
        cascos: $("input[name=cascos]").val(),
        ubicacion: $("input[name=ubicacion]").val(),
      },
      success:function(response){
        
        //alert("response"+response);
        // Response is the output of action file
        if(response == 1){
          imprimirRecibo(placa,descripcion,cascos);
        }
        
        else{
          alert(response);
        }
      }
    });

  }
}


function btnimprimirRecibo(placa,descripcion,cascos,fecha_ingreso,ubicacion){
 //alert(placa+"-"+descripcion+"-"+cascos+"-"+fecha_ingreso);
 imprimirRecibo(placa,descripcion,cascos,fecha_ingreso,ubicacion);
}

function imprimirRecibo(placa,descripcion,cascos,fecha_ingreso,ubicacion) {


  var politicas ="NOTA: No se responde por objetos dejados en la moto, ni se responde por cascos que estén sin marcar.";
  var horario ="HORARIO: Lunes a Sábado  "+"\n"+" de 7:00 AM a 9:00 PM ";
  var direccion ="Cra 20 # 17-35 Centro";
  var nit ="75104251";
  var celular ="3172519808";
 
 
   
var ventanaImpresion = window.open('', '_self');
ventanaImpresion.document.write('<html><head><title>Parqueadero liborio lopera</title>');
ventanaImpresion.document.write('<style>@page { size: 60mm 120m; margin: 0; }</style>'); // Configurar el tamaño de la página para una impresora térmica de 80mm de ancho
ventanaImpresion.document.write('</head><body>');

ventanaImpresion.document.write('<center><p>Parqueadero <br/> Liborio Lopera</p><center>');
ventanaImpresion.document.write('<center><p>'+direccion+'</p><center>');
ventanaImpresion.document.write('<center><p> NIT: '+nit+'</p><center>');
ventanaImpresion.document.write('<center><p> CELULAR: '+celular+'</p><center>');
ventanaImpresion.document.write('<center><p> *************** <br/> PLACA:  '+placa+'<br/>        ***************<p><center>');
ventanaImpresion.document.write('<center><p>'+fecha_ingreso+'</p><center>');
ventanaImpresion.document.write('<center><p> CASCOS: '+cascos+'</p><center>');
ventanaImpresion.document.write('<center><p> UBICACIÓN: <br/>'+ubicacion+'</p><center>');
ventanaImpresion.document.write('<center><p> DESCRIPCIÓN: <br/> '+descripcion+'</p><center>');
ventanaImpresion.document.write('<center><p>'+horario+'</p><center>');
ventanaImpresion.document.write('<center><p>'+politicas+'</p><center>');

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
          location.reload();
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





function cambiarTabla(id,tabla) {
    $.ajax({
      // Action
      url: 'model/typoServicio.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        id: id,
        tabla: tabla,
      },
      success:function(response){
        
        //alert("response"+response);
        // Response is the output of action file
        if(response == 1){
         alert(response);
         location.reload();
         
        }
        
        else{
          alert(response);
          location.reload();
        }
      }
    });

  }

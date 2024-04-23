
function guardarDatos() {

  
    var placa = document.getElementById('placa').value.trim();
    var descripcion = document.getElementById('descripcion').value.trim();
    var cascos = document.getElementById('cascos').value.trim();
    var ubicacion =  document.getElementById('ubicacion').value.trim();

    if (placa === "") {
        alert("la placa  no estan registrada...");
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
            
           var horaActual = obtenerHoraConFormato();
            imprimirRecibo(placa,descripcion,cascos,horaActual, ubicacion);
          }
          
          else{
            alert(response);
          }
        }
      });

    }
}


function actualizarDatosMoto() {

  
  var idMoto2 = document.getElementById('idMoto').value.trim();
  var placa2 = document.getElementById('placa2').value.trim();
  var valor_cobrado2 =  document.getElementById('valor_cobrado2').value.trim();
  var fecha_salida2 =  document.getElementById('fecha_salida2').value.trim();
  var estado2 =  document.getElementById('estado2').value.trim();
 
  alert(placa2);
  

  if (placa2 === "") {
      alert("la placa  no estan registrada...");
  } else {
     
    $.ajax({
      // Action
      url: 'php/updateMoto.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        idMoto: $("input[name=idMoto]").val(),
        placa2: placa2,
        valor_cobrado: $("input[name=valor_cobrado2]").val(),
        fecha_salida: $("input[name=fecha_salida2]").val(),
        estado2: estado2,
       },
      success:function(response){
        alert(response);
        //alert("response"+response);
        // Response is the output of action file
        if(response == 1){
          
        //  location.reload();
        
        }        
        else{
          //location.reload();
        }
      }
    });

  }
}




function eliminarMoto(id,placa){
 
 if (confirm("¿Estás seguro de que deseas eliminar moto "+placa+",continuar?")) {
  // Si el usuario hace clic en "Aceptar", realizamos la acción deseada


  $.ajax({
    // Action
    url: 'php/eliminarMoto.php',
    // Method
    type: 'POST',
    data: {
      // Get value
      id: id,
    },
    success:function(response){
      
      //alert("response"+response);
      // Response is the output of action file
      if(response == 1){
        location.reload();
      }
      
      else{
        alert(response);
        location.reload();
      }
    }
  });

  alert("¡Acción confirmada!");
} else {
  // Si el usuario hace clic en "Cancelar", podemos realizar alguna otra acción o simplemente no hacer nada
  //alert("Acción cancelada");
} 
}


function guardarDatosLavadas() {

  
  var placa = document.getElementById('placa').value.trim();
  var descripcion = document.getElementById('descripcion').value.trim();
  var cascos = document.getElementById('cascos').value.trim();
  var ubicacion =  document.getElementById('ubicacion').value.trim();
  

  if (placa === "" || cascos === "") {
      alert("la placa o los cascos no estan registrados...");
  }  else {

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
        
      var horaActual = obtenerHoraConFormato();
        imprimirRecibo(placa,descripcion,cascos,horaActual,ubicacion);
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

 var fecha ="";
  if(typeof fecha_ingreso === 'undefined'){
    var horaActual = obtenerHoraConFormato();
    fecha = horaActual;
  }else{
    fecha =fecha_ingreso;
  }


  var politicas ="Nota: No se responde por objetos dejados en la moto, ni se responde por cascos que estén sin marcar.";
  var horario ="Horario: Lunes a Sábado  "+"\n"+" de 7:30 AM a 8:30 PM ";
  var direccion ="Cra 20 # 17-35 Centro";
  var nit ="75104251";
  var celular ="3172519808";
 
 
   
var ventanaImpresion = window.open('', '_self');
ventanaImpresion.document.write('<html><head><title>Parqueadero liborio lopera</title>');
ventanaImpresion.document.write('<style>@page { size: 60mm 120m; margin: 0; }</style>'); // Configurar el tamaño de la página para una impresora térmica de 80mm de ancho
ventanaImpresion.document.write('</head><body>');
ventanaImpresion.document.write('<center><label>PARQUEADERO <br/> LIBORIO LOPERA</label><center>');
ventanaImpresion.document.write('<center><label>'+direccion+'</label><center>');
ventanaImpresion.document.write('<center><label> Nit: '+nit+'</label><center>');
ventanaImpresion.document.write('<center><label> Celular: '+celular+'</label><center>');
ventanaImpresion.document.write(' <br/>');
ventanaImpresion.document.write('<center><label style="text-transform:uppercase"> *************** <br/> PLACA:  '+placa+'<br/>        ***************</label><center>');
ventanaImpresion.document.write('<center><label>'+fecha+'</label><center>');
ventanaImpresion.document.write('<center><label> Cascos: '+cascos+'</label><center>');
ventanaImpresion.document.write('<center><label> Ubicación: <br/>'+ubicacion+'</label><center>');
ventanaImpresion.document.write('<center><label> Descripción: <br/> '+descripcion+'</label><center>');
ventanaImpresion.document.write(' <br/>');
ventanaImpresion.document.write('<center><label>'+horario+'</label><center>');
ventanaImpresion.document.write('<center><label>'+politicas+'</label><center>');

ventanaImpresion.document.write('</body></html>');
ventanaImpresion.document.close();

ventanaImpresion.onafterprint = function () {
    window.location.reload(); // Recargar la página después de imprimir
};
ventanaImpresion.print();


}

function obtenerHoraConFormato() {
  // Obtener la fecha y hora actual en el huso horario de Colombia (GMT-5)
  var fechaHoraActual = new Date().toLocaleString("en-US", {timeZone: "America/Bogota"});
  fechaHoraActual = new Date(fechaHoraActual);

  // Obtener las partes de la fecha y hora
  var ano = fechaHoraActual.getFullYear();
  var mes = fechaHoraActual.getMonth() + 1; // Se suma 1 porque en JavaScript los meses van de 0 a 11
  var dia = fechaHoraActual.getDate();
  var hora = fechaHoraActual.getHours();
  var minutos = fechaHoraActual.getMinutes();
  var segundos = fechaHoraActual.getSeconds();
  var ampm = hora >= 12 ? 'PM' : 'AM';

  // Convertir la hora al formato de 12 horas
  hora = hora % 12;
  hora = hora ? hora : 12; // '0' debería mostrarse como '12'

  // Agregar un cero delante de la hora si es menor que 10
  hora = hora < 10 ? '0' + hora : hora;

  // Agregar un cero delante del mes si es menor que 10
  mes = mes < 10 ? '0' + mes : mes;

  // Agregar un cero delante de los minutos si son menores que 10
  minutos = minutos < 10 ? '0' + minutos : minutos;
  // Agregar un cero delante de los segundos si son menores que 10
  segundos = segundos < 10 ? '0' + segundos : segundos;

  // Construir la cadena de fecha y hora con el formato deseado
  var fechaHoraConFormato = ano + '-' + mes + '-' + dia + ' ' + hora + ':' + minutos + ':' + segundos + ' ' + ampm;

  return fechaHoraConFormato;
}


function saveingresos(){


  document.getElementById("saveingresos").disabled = true;
  
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

  document.getElementById("saveegresos").disabled = true;
 
  
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
  document.querySelectorAll(".valor").forEach(el => el.addEventListener("keyup", integerFormatIndistinto));;
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



  function savecaja(){
    
    var inicio_monedas = document.getElementById('inicio_monedas').value.trim();
    var fin_monedas = document.getElementById('fin_monedas').value.trim();
    var fin_billetes = document.getElementById('fin_billetes').value.trim();
    var observaciones = document.getElementById('observaciones').value.trim();
  
    
    if (inicio_monedas === "") {
        alert("ingrese el inicio de monedas");
    } else {
     
        // Crear objeto con datos a enviar
        var datos = {
          inicio_monedas: inicio_monedas,
          fin_monedas: fin_monedas,
          fin_billetes:fin_billetes,
          observaciones:observaciones
        };
  
        
      $.ajax({
        // Action
        url: 'php/addCaja.php',
        // Method
        type: 'POST',
        data: {
          
          inicio_monedas: $("input[name=inicio_monedas]").val(),
          fin_monedas: $("input[name=fin_monedas]").val(),
          fin_billetes: $("input[name=fin_billetes]").val(),
          observaciones:$("input[name=observaciones]").val(),

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
  

  
  function editcaja(){
    
    var inicio_monedas = document.getElementById('inicio_monedas2').value.trim();
    var fin_monedas = document.getElementById('fin_monedas2').value.trim();
    var fin_billetes = document.getElementById('fin_billetes2').value.trim();
    var observaciones = document.getElementById('observaciones2').value.trim();
    var id_caja = document.getElementById('idcaja').value.trim();
  
    
    if (inicio_monedas === "") {
        alert("ingrese el inicio de monedas");
    } else {
     
        // Crear objeto con datos a enviar
        var datos = {
          inicio_monedas: inicio_monedas,
          fin_monedas: fin_monedas,
          fin_billetes:fin_billetes,
          observaciones:observaciones,          
          id_caja:id_caja
        };
  
        
      $.ajax({
        // Action
        url: 'php/editCaja.php',
        // Method
        type: 'POST',
        data: {
          
          inicio_monedas: $("input[name=inicio_monedas2]").val(),
          fin_monedas: $("input[name=fin_monedas2]").val(),
          fin_billetes: $("input[name=fin_billetes2]").val(),
          observaciones:$("input[name=observaciones2]").val(),          
          id_caja:$("input[name=idcaja]").val(),

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


  function imprimirRecibo2(placa,descripcion,cascos,fecha_ingreso,ubicacion,fechasalida,valor) {

   // alert(placa+descripcion+cascos+fecha_ingreso+ubicacion+fechasalida+valor)
   
     var politicas ="Nota: No se responde por objetos dejados en la moto, ni se responde por cascos que estén sin marcar.";
     var horario ="Horario: Lunes a Sábado  "+"\n"+" de 7:30 AM a 8:30 PM ";
     var direccion ="Cra 20 # 17-35 Centro";
     var nit ="75104251";
     var celular ="3172519808";
     
      
   var ventanaImpresion = window.open('', '_self');
   ventanaImpresion.document.write('<html><head><title>PARQUEADERO LIBORIO LOPERA</title>');
   ventanaImpresion.document.write('<style>@page { size: 60mm 120m; margin: 0; }</style>'); // Configurar el tamaño de la página para una impresora térmica de 80mm de ancho
   ventanaImpresion.document.write('</head><body>');
   
   ventanaImpresion.document.write('<center><label>PARQUEADERO <br/> LIBORIO LOPERA</label><center>');
   ventanaImpresion.document.write('<center><label>'+direccion+'</label><center>');
   ventanaImpresion.document.write('<center><label> Nit: '+nit+'</label><center>');
   ventanaImpresion.document.write('<center><label> Celular: '+celular+'</label><center>');
   ventanaImpresion.document.write(' <br/>');
   ventanaImpresion.document.write('<center><label style="text-transform:uppercase"> *************** <br/> PLACA:  '+placa+'<br/>        ***************<label><center>');
   ventanaImpresion.document.write('<center><label> Fecha Ingreso <br/>'+fecha_ingreso+'</label><center>');
   ventanaImpresion.document.write('<center><label> Valor Cobrado <br/>'+valor+'</label><center>');
   ventanaImpresion.document.write('<center><label> Fecha Salida <br/>'+fechasalida+'</label><center>');
   ventanaImpresion.document.write('<center><label> Cascos: '+cascos+'</label><center>');
   ventanaImpresion.document.write('<center><label> Ubicación: <br/>'+ubicacion+'</label><center>');
   ventanaImpresion.document.write('<center><label> Descripción: <br/> '+descripcion+'</label><center>');
   ventanaImpresion.document.write(' <br/>');
   ventanaImpresion.document.write('<center><label>'+horario+'</label><center>');
   ventanaImpresion.document.write('<center><label>'+politicas+'</label><center>');
   
   ventanaImpresion.document.write('</body></html>');
   ventanaImpresion.document.close();
   
   ventanaImpresion.onafterprint = function () {
       window.location.reload(); // Recargar la página después de imprimir
   };
   ventanaImpresion.print();
   
   
   }


   $(document).ready(function() {
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var cajaId = button.data('caja-id');
      var inicioMonedas = button.data('caja-inicio-monedas');      
      var fin_monedas2 = button.data('caja-fin-monedas');
      var fin_billetes2 = button.data('caja-fin-billetes');
      var observaciones2 = button.data('caja-observaciones');

     
      // Fill modal form with user data
      $('#idcaja').val(cajaId);
      $('#inicio_monedas2').val(inicioMonedas);
      $('#fin_monedas2').val(fin_monedas2);
      $('#fin_billetes2').val(fin_billetes2);
      $('#observaciones2').val(observaciones2);
    });
  
  });
  

  
  $(document).ready(function() {
    $('#editModalMoto').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var idMoto = button.data('moto-id');
      var placa = button.data('moto-placa');
      var descripcion = button.data('moto-descripcion');
      var valor_cobrado = button.data('moto-valor-cobrado');
      var fecha_salida = button.data('moto-fecha-salida');
      var estado = button.data('moto-estado');
      var cascos = button.data('moto-casco');
      var ubicacion = button.data('moto-ubicacion');


     
      // Fill modal form with user data
      $('#idMoto').val(idMoto);
      $('#placa2').val(placa);
      $('#descripcion2').val(descripcion);
      $('#valor_cobrado2').val(valor_cobrado);
      $('#fecha_salida2').val(fecha_salida);      
      $('#estado2').val(estado);      
      $('#cascos2').val(cascos);      
      $('#ubicacion2').val(ubicacion);
    });
  
  });
  
  
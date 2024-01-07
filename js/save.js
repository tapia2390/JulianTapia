
function guardarDatos() {
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
    var contenidoRecibo = document.getElementById('container-fluid2').innerHTML;

    var ventanaImpresion = window.open('', '_self');
    ventanaImpresion.document.write('<html><head><title>Recibo</title></head><body>');
    ventanaImpresion.document.write('<h4><center>*** PARQUEADERO JT ***</h4><h2><center>Placa: <strong style="color:blue;">'+placa+'</strong></center></h2><h3><center>Cascos: <strong>'+cascos+'</strong></center></h3><h3><center>Descripción: <strong>'+descripcion+'</strong></center></h3><h5><center>Al estacionar en nuestro parqueadero, reconoces <br>que no nos hacemos responsables por daños o robos<br> Horario de Lunes a Sabado de 7:00 AM a 9:00 PM <br> Cel: 310-000-000 </center></h5>');
    ventanaImpresion.document.write('</body></html>');
    ventanaImpresion.document.close();

    ventanaImpresion.onafterprint = function () {
        window.location.reload(); // Recargar la página después de imprimir
    };
    ventanaImpresion.print();


}




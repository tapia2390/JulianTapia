
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
            imprimirRecibo();
          }
          
          else{
            alert("error");
          }
        }
      });

    }
}

function imprimirRecibo() {
    var contenidoRecibo = document.getElementById('container-fluid2').innerHTML;

    var ventanaImpresion = window.open('', '_self');
    ventanaImpresion.document.write('<html><head><title>Recibo</title></head><body>');
    ventanaImpresion.document.write(contenidoRecibo);
    ventanaImpresion.document.write('</body></html>');
    ventanaImpresion.document.close();

    ventanaImpresion.onafterprint = function () {
        window.location.reload(); // Recargar la página después de imprimir
    };
    ventanaImpresion.print();


}




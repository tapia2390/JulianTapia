


function imprimirRecibo() {
    var contenidoRecibo = document.getElementById('container-fluid').innerHTML;

    var ventanaImpresion = window.open('', '_self');
    ventanaImpresion.document.write('<html><head><title>Recibo</title></head><body>');
    ventanaImpresion.document.write(contenidoRecibo);
    ventanaImpresion.document.write('</body></html>');
    ventanaImpresion.document.close();

    ventanaImpresion.onafterprint = function() {
        window.location.reload(); // Recargar la página después de imprimir
    };
    ventanaImpresion.print();

    
}
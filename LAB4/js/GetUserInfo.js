$(document).ready(
    function() {
        $.get('../xml/Users.xml', function(d){
            var listacorreos = $(d).find('email'); 
            for (var i = 0; i < listacorreos.length; i++) {
                $('#lista').append($('<option>',{
                value: listacorreos[i].childNodes[0].nodeValue,
                text: listacorreos[i].childNodes[0].nodeValue }));
            }
    })
});

$(document).change( 
    function(){
        $.get('../xml/Users.xml', function(d){
            var exist = 0;
            var usuarios = $(d).find('usuario').each(function(){
                var $this = $(this);
                var email = $this.find('email').text();
                var nombre = $this.find('nombre').text();
                var apellidos = $this.find('apellido1').text() + " " + $this.find('apellido2').text();
                var telefono = $this.find('telefono').text();
                if (email == $('#email').val()) {
                    $('#nombre').html(nombre);
                    $('#apellidos').html(apellidos);
                    $('#telefono').html(telefono);
                    
                    exist=1; //variable flag
                }
            })
            
            if (exist == 0) {
                $('#nombre').html("");
                $('#apellidos').html("");
                $('#telefono').html("");
                alert("El email no pertenece a ningún usuario, ingrese otro.");
            }
            
        })
    });
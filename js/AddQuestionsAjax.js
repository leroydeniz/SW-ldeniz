$(document).ready(function () {
   $('#enviarsolicitud').click(function (event) {
       event.preventDefault();
       
       //me guardo el objeto formulario en una variable
       var form = document.getElementById('fquestion');
       var data = new FormData(form);
       
       $.ajax({
           type: 'POST',
           enctype: 'multipart/form-data',
           url: '../php/AddQuestionsAjax.php',
           data: data,
           processData: false,
           contentType: false,
           cache: false,
           timeout: 100000,
           success: function(data) {
			   console.log(data);
			   $("#avisos").html(data);
			   if (data == 'Pregunta ingresada correctamente') {
               		$("#preguntas").click(ShowQuestions());
			   } else {
				   $("#preguntas").click(ResetForm());
			   }
           },
           error: function(e) {
			   console.log(e);
               $("#preguntas").click(ResetForm());
			   $("#avisos").click(ResetForm());
           }
       });
   }); 
});
$(document).ready(function () {
   $('#enviarsolicitud').click(function (event) {
       event.preventDefault();
       
       //me guardo el objeto formulario en una variable
       var form = document.getElementById('fquestion');
       var data = new FormData(form);
       
       $.ajax({
           type: 'POST',
           enctype: 'multipart/form-data',
           //url: '../php/AddQuestionsAjax.php',
           url: '../php/AddQuestionWithImage.php',
           data: data,
           processData: false,
           contentType: false,
           cache: false,
           timeout: 100000,
           success: function(data) {
               console.log('Todo correcto : ', data);
               $("#preguntas").click(ShowQuestions());
           },
           error: function(e) {
               console.log("Ha ocurrido un problema : ",e);
               $("#preguntas").click(ResetForm());
           }
       });
   }); 
});
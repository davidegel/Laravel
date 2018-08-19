
    $.ajax({
        type: "GET",
        url: "http://laravel.loc/user/ajax/resources",
        dataType: "json",
        success: function (data) {
            //$('#content').html(data.html);
            //console.log(data.dati.utenti);
            displayData(data);
        }
    });


    function displayData(data) { 
        
        var utenti = data.dati.utenti;
        var nome_utente = "";
        var auto = "";
        
        var table = '<table border="1">';
        table += '<tr><th>Month</th><th>Savings</th></tr>';
        table +='<tr>';
        $.each(utenti, function (index, value) {
        
         table += '<td>';
         table += value.nome;
         table += "<td>";

         table +='</tr>';
         
         $.each(value.auto, function (indexInArray, valueOfElement) { 
              
              table += '<td>';
              table += valueOfElement;
              table += "<td>";

         });
         
         
        });
        table +='</tr>'; 
        table +='</table>'; 

        $('#utenti').html(table);
   }


    function sendServer() { 

     var nome = $('#nome').val();
     var email = $('#email').val();
     var action = 'invia';

     $.ajax({
         type: "POST",
         url: "http://laravel.loc/user/ajax/post",
         data: { action: action, nome: nome, email: email },
         dataType: "json",
         success: function (response) {
             alert(response.msg);
         },
         error: function (data, textStatus, errorThrown) {
             console.log(data);
     
         },
     });

   }
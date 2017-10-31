<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>idem page1 mais version Ajax</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="stylesheet" href="style/todoliste1.css"  type="text/css" charset="utf_8"/>-->
        <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
          <script  src="https://code.jquery.com/jquery-3.2.1.js"></script>
          <script src=" https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" ></script>

    </head>
    <body>

      <p><b>Chercher un mot-clef:</b></p>
        <form>
            Premieres lettres: <input type="text" id="txt" > <!--on a ici retiré le onkeyup de la version precedente-->
           
          
        </form>
        <p>Suggestions: <span id="word"></span></p>


    <script>



        $(document).ready(
                function () {
                $("#txt").keyup(function(e){
                $.ajax({
                type: "GET",
                        url: "page2.php",
                        data : {"q" : $("#txt").val()},
                        dataType: "html",
                        success: function(data) {
                        $("#word").html(data);
                        }
                });
                });
                });//fin document ready



    </script>

</body>
</html>
<!DOCTYPE html>
<!--
AJAX en version hyper contratée, la plus efficace
-->
<html>
    <head>
        <title>idem page1 mais version Ajax encore plus courte</title>
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
        <p>login déjà present dans la base: <span id="word"></span></p>


        <script>
            $(document).ready(
                    function () {
                        $("#txt").keyup(function () {
                            $("#word").load("connexion.php", {q: $("#txt").val()});
                        });
                    }); //fin document ready
        </script>

    </body>
</html>
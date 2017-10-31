<!DOCTYPE html>
<!-- page1.php -->
<html>
    <head>
        <script>
            function findKeyWord(str) {
                if (str.length == 0) {
                    document.getElementById("word").innerHTML = "";
                    return;
                } else {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById("word").innerHTML = xhr.
                                    responseText;
                        }
                    }
                    xhr.open("GET", "page2.php?q=" + str, true);
                    xhr.send();
                }
            }
        </script>
    </head>
    <body>
        <p><b>Chercher un mot-clef:</b></p>
        <form>
            Premieres lettres: <input type="text" id="txt" onkeyup
                                      = "findKeyWord(this.value)">
        </form>
        <p>Suggestions: <span id="word"></span></p>
    </body>
</html>

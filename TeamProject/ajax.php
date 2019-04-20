<?php
if ($_SERVER['REQUEST_METHOD']=="POST"){

header("Location: asdasda.html"); die();
  // Array with names
  $a[] = "Anna";
  $a[] = "Brittany";
  $a[] = "Cinderella";
  $a[] = "Diana";
  $a[] = "Eva";
  $a[] = "Fiona";
  $a[] = "Gunda";
  $a[] = "Hege";
  $a[] = "Inga";
  $a[] = "Johanna";
  $a[] = "Kitty";
  $a[] = "Linda";
  $a[] = "Nina";
  $a[] = "Ophelia";
  $a[] = "Petunia";
  $a[] = "Amanda";
  $a[] = "Raquel";
  $a[] = "Cindy";
  $a[] = "Doris";
  $a[] = "Eve";
  $a[] = "Evita";
  $a[] = "Sunniva";
  $a[] = "Tove";
  $a[] = "Unni";
  $a[] = "Violet";
  $a[] = "Liza";
  $a[] = "Elizabeth";
  $a[] = "Ellen";
  $a[] = "Wenche";
  $a[] = "Vicky";

  // get the q parameter from URL
  $q = $_REQUEST["q"];

  $hint = "";

  // lookup all hints from array if $q is different from ""
  if ($q !== "") {
      $q = strtolower($q);
      $len=strlen($q);
      foreach($a as $name) {
          if (stristr($q, substr($name, 0, $len))) {
              if ($hint === "") {
                  $hint = $name;
              } else {
                  $hint .= ", $name";
              }
          }
      }
  }

  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "no suggestion" : $hint;
  die();
}else echo $_SERVER['REQUEST_METHOD'].'<br><br>';
?>
<html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          console.log("AJAX");
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }else if (this.readyState == 4 && this.status == 404) {
              document.getElementById("txtHint").innerHTML = "OH NO!!!!!! Something awful happend";
            }
        };
        xmlhttp.open("POST", "ajax.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form>
  First name: <input type="text" onkeyup="showHint(this.value)">
  Last name: <input type="text" id="lname">
</form>
<p>Suggestions: <span id="txtHint"></span></p>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
$(function(){

  $('#lname').keyup( function(e){
    var lanme = $("#lname").val();
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: "q="+encodeURI(lanme),
      success: function(data) {
        $("#txtHint").html(data);
      }, error : function(e) {
        $("#txtHint").html("Uh Oh! An error occured");
      }
    });
  });
})
</script>

</body>
</html>

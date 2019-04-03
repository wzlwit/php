function validation() {
  var user = $("#usrname").val();
  var pass = $("#psw").val();

  if (user == "" && pass == "") {
    $("#msg").html("Login: Please complete all the infomations!!");
    return false;
  } else {
    if (user == "") {
      $("#msg").html("Login: Please enter your Email!!");
      return false;
    }
    if (pass == "") {
      $("#msg").html("Login: Please enter your PASSWORD!");
      return false;
    }
  }
  $.ajax({
    url: "login.php",
    type: "POST",
    dataType: "json",
    data: { email: user, password: pass },
    beforeSend: function() {
      $("#msg")
        .addClass("text-success")
        .text("login...");
    },
    success: function(res) {
      if (res.code == 1) {
        //登录成功
        $("#msg").html(res.code);
        location.href = 'index.php';
      } else {
        $("#msg").html('password not correct');
        return false;
      }
    },
  });
  return false;
}

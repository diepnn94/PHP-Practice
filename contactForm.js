function validate(){
  $("#success").addClass("hidden");
  var phone = $("#phone").val();
  var name = $("#name").val();
  var email = $("#email").val();
  var message = $("#message").val();
  var valid = 0;

  var nameRegex = new RegExp("^[a-zA-Z ]*$");
  var nameTest = nameRegex.test(name);
  if (nameTest == false){
    $("#nameErr").removeClass('hidden');
    valid++;
  }
  else if (nameTest == true) {
    $("#nameErr").addClass('hidden');
  }

  var phoneRegex = new RegExp("^[0-9]*$");
  var phoneTest = phoneRegex.test(phone);
  if(phone.length != 10 || phoneTest == false) {
    $("#phoneErr").removeClass('hidden');
    valid++;
  }
  else if (phone.length == 10 && phoneTest == true) {
    $("#phoneErr").addClass('hidden');
  }

  if (valid ==0){
    $("#sendingMail").removeClass('hidden');
    $.ajax({
      url: 'mail.php',
      type: 'POST',
      data: "name="+name + "&email="+email + "&phone=" +phone + "&message=" + message,
      success: function(text){
        if (text == "success"){
          $("#sendingMail").addClass('hidden');
          $("#success").removeClass("hidden");
          $("#nameErr").addClass('hidden');
          $("#phoneErr").addClass('hidden');
          document.getElementById("contactForm").reset();
        }
      }
    });
  }
}


$(function(){
  $("#contactForm").on("submit", function(e){
    e.preventDefault();
    validate();
  })
})

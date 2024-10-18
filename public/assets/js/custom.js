
$( function() {
    $( "#dob" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $( "#hire_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $( "#terminate_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    document.getElementById('user_email').onkeydown = function (e) {
        e.preventDefault();
    };
    document.getElementById('user_email').oncut = function (e) {
        e.preventDefault();
    };
    document.getElementById('user_email').onpaste = function (e) {
        e.preventDefault();
    };
  } )
  function changeSpouseValue() {
    var checkBox = document.getElementById("agentSpouse");
    if (checkBox.checked == true){
      $('#agentSpouse').val('1');
    } else {
        $('#agentSpouse').val('0');
    }
  }
  function changeDisplayValue() {
    var checkBox = document.getElementById("display_on_web");
    if (checkBox.checked == true){
      $('#display_on_web').val('1');
    } else {
        $('#display_on_web').val('0');
    }
  }
  
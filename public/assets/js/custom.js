
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

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
  } )
  function changeSpouseValue() {
    var checkBox = document.getElementById("agentSpouse");
    if (checkBox.checked == true){
      $('#agentSpouse').val('1');
    } else {
        $('#agentSpouse').val('0');
    }
  }
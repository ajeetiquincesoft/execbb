
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

  function changeFranchiseValue() {
   var checkBox = document.getElementById("franchise");
    if (checkBox.checked == true){
      $('#franchise').val('1');
    } else {
        $('#franchise').val('0');
    } 
  }
  function changeReviewValue() {
    var checkBox = document.getElementById("review");
     if (checkBox.checked == true){
       $('#review').val('1');
     } else {
         $('#review').val('0');
     } 
   }
   function changeBasementValue() {
    var checkBox = document.getElementById("basement");
     if (checkBox.checked == true){
       $('#basement').val('1');
     } else {
         $('#basement').val('0');
     } 
   }
   function changeFeatureValue() {
    var checkBox = document.getElementById("featuredListing");
     if (checkBox.checked == true){
       $('#featuredListing').val('1');
     } else {
         $('#featuredListing').val('0');
     } 
   }
   function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form
            document.getElementById('delete-agent-' + id).submit();
        }
    });
}

   
   
  
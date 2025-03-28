
$(function () {
  document.getElementById('user_email').onkeydown = function (e) {
    e.preventDefault();
  };
  document.getElementById('user_email').oncut = function (e) {
    e.preventDefault();
  };
  document.getElementById('user_email').onpaste = function (e) {
    e.preventDefault();
  };
})
function changeSpouseValue() {
  var checkBox = document.getElementById("agentSpouse");
  if (checkBox.checked == true) {
    $('#agentSpouse').val('1');
  } else {
    $('#agentSpouse').val('0');
  }
}
function changeDisplayValue() {
  var checkBox = document.getElementById("display_on_web");
  if (checkBox.checked == true) {
    $('#display_on_web').val('1');
  } else {
    $('#display_on_web').val('0');
  }
}

function changeFranchiseValue() {
  var checkBox = document.getElementById("franchise");
  if (checkBox.checked == true) {
    $('#franchise').val('1');
  } else {
    $('#franchise').val('0');
  }
}
function changeReviewValue() {
  var checkBox = document.getElementById("review");
  if (checkBox.checked == true) {
    $('#review').val('1');
  } else {
    $('#review').val('0');
  }
}
function changeBasementValue() {
  var checkBox = document.getElementById("basement");
  if (checkBox.checked == true) {
    $('#basement').val('1');
  } else {
    $('#basement').val('0');
  }
}
function changeFeatureValue() {
  var checkBox = document.getElementById("featuredListing");
  if (checkBox.checked == true) {
    $('#featuredListing').val('1');
  } else {
    $('#featuredListing').val('0');
  }
}
function changeSFBOValue() {
  var checkBox = document.getElementById("sfbo");
  if (checkBox.checked == true) {
    $('#sfbo').val('1');
  } else {
    $('#sfbo').val('0');
  }
}
function changeREInCValue() {
  var checkBox = document.getElementById("reInc");
  if (checkBox.checked == true) {
    $('#reInc').val('1');
  } else {
    $('#reInc').val('0');
  }
}
function changeListedValue() {
  var checkBox = document.getElementById("listed");
  if (checkBox.checked == true) {
    $('#listed').val('1');
  } else {
    $('#listed').val('0');
  }
}

function changeRealStateTransValue() {
  var checkBox = document.getElementById("realEstateTransaction");
  if (checkBox.checked == true) {
    $('#realEstateTransaction').val('1');
  } else {
    $('#realEstateTransaction').val('0');
  }
}

function changeCheckOnHoldValue() {
  var checkBox = document.getElementById("checkOnHold");
  if (checkBox.checked == true) {
    $('#checkOnHold').val('1');
  } else {
    $('#checkOnHold').val('0');
  }
}
function changeCheckBouncedValue() {
  var checkBox = document.getElementById("bounced");
  if (checkBox.checked == true) {
    $('#bounced').val('1');
  } else {
    $('#bounced').val('0');
  }
}
function changeRealEstateIncludedValue() {
  var checkBox = document.getElementById("realEstateIncluded");
  if (checkBox.checked == true) {
    $('#realEstateIncluded').val('1');
  } else {
    $('#realEstateIncluded').val('0');
  }
}
function changeOptionToBuyValue() {
  var checkBox = document.getElementById("optionToBuy");
  if (checkBox.checked == true) {
    $('#optionToBuy').val('1');
  } else {
    $('#optionToBuy').val('0');
  }
}

function confirmDelete(id) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // If confirmed, submit the form
      document.getElementById('delete-agent-' + id).submit();
    }
  });
}
function listingDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-form-' + customId).submit();
    }
  });
}
function leadDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-form-' + customId).submit();
    }
  });
}
function buyerDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-buyer-' + customId).submit();
    }
  });
}
function offerDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-offer-' + customId).submit();
    }
  });
}
function contactDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-contact-' + customId).submit();
    }
  });
}
function referralDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-referral-' + customId).submit();
    }
  });
}
function showingDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-showing-' + customId).submit();
    }
  });
}
function categoryDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-category-' + customId).submit();
    }
  });
}
function referralTypeDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-referral-type-' + customId).submit();
    }
  });
}

function contactTypeDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-contact-type-' + customId).submit();
    }
  });
}

function probmatchDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-probmatch-' + customId).submit();
    }
  });
}
function criteriaDelete(customId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      document.getElementById('delete-criteria-' + customId).submit();
    }
  });
}
function confirmImage(form) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You want to upload this image!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5e0f2f',
    cancelButtonColor: '#93744b',
    confirmButtonText: 'Yes, confirm it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit the form for deletion
      form.submit();
    }
  });
}

//multi select
/* $(document).ready(function () {
  $('#agent').select2();
});
$(document).ready(function () {
  $('#managementAgentName').select2();
}); */
$(document).ready(function () {
  $('#recipientEmail').select2();
  $('#listingName').select2();
});
$(document).ready(function () {
  const collapsePanel = document.getElementById('collapsetwo');
  const collapseOne = document.getElementById('collapseOne');
  const toggleCollapse = () => {

    // Get the active navigation item
    const activeItem = document.querySelector('#collapsetwo .acc-list .nav-item.activenavitem');
    const activeItemOne = document.querySelector('#collapseOne .acc-list .nav-item.activenavitem');
    console.log(activeItem, 'test');
    const collapseElements = document.querySelectorAll('.accordion-collapse.collapse');  // Select all collapse elements
    collapseElements.forEach((collapseElement) => {
      const collapseId = collapseElement.id;
      // If there's an active item and collapsePanel exists
      if (activeItem || activeItemOne) {
        // Check if the active item corresponds to collapsePanel
        if (activeItem && collapseId === 'collapsetwo') {
          // Show collapsePanel and hide collapseMainMenu
          if (!$(collapsePanel).hasClass('show')) {
            $(collapsePanel).collapse('show');
            $('#collapseMainMenu').collapse('hide');
            $('#collapseOne').collapse('hide');
          }
          // Hide collapseOne if it's open
          if ($(collapseOne).hasClass('show')) {
            $(collapseOne).collapse('hide');
          }
        }

        // Check if the active item corresponds to collapseOne
        else if (activeItemOne && collapseId === 'collapseOne') {

          // Show collapseOne and hide collapseMainMenu
          if (!$(collapseOne).hasClass('show')) {
            $(collapseOne).collapse('show');
            $('#collapseMainMenu').collapse('hide');
            $('#collapsetwo').collapse('hide');
          }
          // Hide collapse if it's open
          if ($(collapsePanel).hasClass('show')) {
            $(collapsePanel).collapse('hide');
          }
        }
      } else {
        // If no active item, hide both collapses
        if ($(collapsePanel).hasClass('show')) {
          $(collapsePanel).collapse('hide');
        }
        if ($(collapseOne).hasClass('show')) {
          $(collapseOne).collapse('hide');
        }
      }
    });

  };

  // Call toggleCollapse after 500ms to ensure it's executed after the DOM is ready
  setTimeout(function () {
    toggleCollapse();
  }, 500);


  const currentUrl = window.location.href;
  $('.nav-link').each(function () {
    var linkUrl = $(this).attr('href');
    if (currentUrl.includes(linkUrl)) {
      $(this).closest('.nav-item').addClass('activenavitem');
    }
  });
  $('.nav-link-dropdown').each(function () {
    var linkUrl = $(this).attr('href');
    if (currentUrl.includes(linkUrl)) {
      $(this).closest('.nav-item').addClass('activenavitem');
    }
  });
  $('.nav-link, .nav-link-dropdown').on('click', function () {
    $('.nav-item').removeClass('activenavitem');
    $(this).closest('.nav-item').addClass('activenavitem');
    toggleCollapse();
  });
  setTimeout(function () {
    toggleCollapse();
  }, 500);
});
$(document).ready(function () {
  $('.accordion-button').on('click', function () {
    var targetId = $(this).attr('data-bs-target');
    $('.accordion-collapse').collapse('hide');
    $(targetId).collapse('toggle');
  });
});

/* $(document).ready(function() {
  // Load breadcrumbs from local storage and render them
  loadBreadcrumbs();

  $('.nav-link').on('click', function() {
      var menuName = $(this).data('name');
      var menuUrl = $(this).data('url');

      // Append breadcrumb item
      $('.my_menu').append('<li class="breadcrumb-item"><a href="' + menuUrl + '">' + menuName + '</a></li>');
       // Clear breadcrumb to local storage
      clearBreadcrumbs();
      // Save breadcrumb to local storage
      saveBreadcrumb(menuName, menuUrl);
  });
  $('.nav-link-first').on('click', function() {
    var menuName = $(this).data('name');
    var menuUrl = $(this).data('url');

    // Append breadcrumb item
    $('.my_menu').append('<li class="breadcrumb-item"><a href="' + menuUrl + '">' + menuName + '</a></li>');
     // Clear breadcrumb to local storage
    clearBreadcrumbs();
    // Save breadcrumb to local storage
    saveBreadcrumb(menuName, menuUrl);
});

  // Function to load breadcrumbs from local storage
  function loadBreadcrumbs() {
      var breadcrumbs = JSON.parse(localStorage.getItem('breadcrumbs')) || [];
      breadcrumbs.forEach(function(breadcrumb) {
          $('.my_menu').append('<li class="breadcrumb-item"><a href="' + breadcrumb.url + '">' + breadcrumb.name + '</a></li>');
      });
  }

  // Function to save a breadcrumb to local storage
  function saveBreadcrumb(name, url) {
      var breadcrumbs = JSON.parse(localStorage.getItem('breadcrumbs')) || [];
      breadcrumbs.push({ name: name, url: url });
      localStorage.setItem('breadcrumbs', JSON.stringify(breadcrumbs));
  }

  function clearBreadcrumbs() {
    localStorage.removeItem('breadcrumbs');
    $('.my_menu').html(''); // Clear the displayed breadcrumbs as well
  }
}); */






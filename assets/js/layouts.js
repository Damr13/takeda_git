
  $(document).ready(function () {
    $("#shift-op1").select2({
        placeholder: "Silahkan Pilih"
    });
    
    $("#shift-op2").select2({
        placeholder: "Silahkan Pilih"
    });

    $("#shift-op3").select2({
        placeholder: "Silahkan Pilih"
    });

    $("#shift-ld1").select2({
        placeholder: "Silahkan Pilih"
    });

    $("#shift-ld2").select2({
        placeholder: "Silahkan Pilih"
    });

    $("#shift-ld3").select2({
        placeholder: "Silahkan Pilih"
    });

    $("#dtLists").select2({
      placeholder: "Silahkan Pilih"
    });
});


// Tabs 2 log

function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
  }

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

// Dropdown Shift
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


(function($) {
  'use strict';
  $(function() {
  $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  });
  $(document).ready(function() {
      var listDelete = $('.list-delete');
      listDelete.on('click', function() {
          swal({
              title: "Are you sure?",
              text: "Do you really want to delete this item?",
              icon: "warning",
              buttons: ["Cancel", "Delete Now"],
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                  swal({
                      title: "Deleted",
                      text: "The list item has been deleted!",
                      icon: "success",
                  });
              } else {
                  swal("The item is not deleted!");
              }
          });
      });
      $('.html-editor').summernote({
        height: 300,
        tabsize: 2
      });
  })
  
})(jQuery);
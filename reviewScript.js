//prevents duplicate reviews upon refreshing the page

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }

    /* JavaScript for secret button */


    document.addEventListener('DOMContentLoaded', function() {
        let secretToggle = document.querySelector('.secret-button');
        secretToggle.addEventListener('click', function() {
          let deletion = document.querySelectorAll('.delete-form');
          deletion.forEach(function(element) {
            element.classList.toggle('hide');
          });
        });
      });
      
  
// show the reason and hide the reason field on process request .php
try {
  document.getElementById("reject").addEventListener("click", (e) => {
    if (document.getElementById("showreason").classList.contains("d-none")) {
      document.getElementById("showreason").classList.remove("d-none");
      return;
    }
    return;
  });
  document.getElementById("accept").addEventListener("click", (e) => {
    if (document.getElementById("showreason").classList.contains("d-none")) {
      return;
    }
    document.getElementById("showreason").classList.add("d-none");
    return;
  });
} catch (error) {}
// end of it show the reason and hide the reason field on process request .php

// hide and show of the leftbalance field on process request.php
try {
  document.getElementById("has_not_paid").addEventListener("click", (e) => {
    if (
      document.getElementById("has_not_paid_field").classList.contains("d-none")
    ) {
      document.getElementById("has_not_paid_field").classList.remove("d-none");
    }
    return;
  });
  document.getElementById("has_paid").addEventListener("click", (e) => {
    if (
      document.getElementById("has_not_paid_field").classList.contains("d-none")
    ) {
      return;
    }
    document.getElementById("has_not_paid_field").classList.add("d-none");
  });
} catch (error) {}
// end of it hide and show of the leftbalance field on process request.php

function toggleActiveLink(link){
  if(!link.classList.contains("active")){
    link.classList.toggle("active");
  }
}

$(window).on("load",function(){
  $(".loader-wrapper").fadeOut("slow");
});
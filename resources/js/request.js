function checkLengthReasonTextArea(element) {
  const span = document.getElementById("other");
  if (element.value == null) {
    return;
  }
  if (element.value.length > 94) {
    if (span.classList.contains("d-none")) {
      span.classList.remove("d-none");
    }
    span.textContent = "Please make it brief use less than 93 characters";
  } else {
    if (!span.classList.contains("d-none")) {
      span.classList.add("d-none");
    }
    span.textContent = "";
  }
}
function change(event) {
  let reason_text_area = document.getElementById("reason_text_area");
  let sickness_form = document.getElementById("sickness_form");
  if (event.value == "sickness") {
    if (sickness_form.classList.contains("d-none")) {
      sickness_form.classList.remove("d-none");
    }
    if (!reason_text_area.classList.contains("d-none")) {
      reason_text_area.classList.add("d-none");
    }
  }
  if (event.value == "payment") {
    const span = document.getElementById("other");
    if (!sickness_form.classList.contains("d-none")) {
      sickness_form.classList.add("d-none");
    }
    if (!reason_text_area.classList.contains("d-none")) {
      reason_text_area.classList.add("d-none");
    }
    if (!span.classList.contains("d-none")) {
      span.classList.add("d-none");
    }
  }
  if (event.value == "other") {
    if (!sickness_form.classList.contains("d-none")) {
      sickness_form.classList.add("d-none");
    }
    if (reason_text_area.classList.contains("d-none")) {
      reason_text_area.classList.remove("d-none");
    }
  }
}

function secondQn(element) {
  let firstInputs = document.getElementsByClassName("i_have_paid");
  let secondInputs = document.getElementsByClassName("part_amount_paid");
  if (element.value == "i_have_paid") {
    for (let index = 0; index < firstInputs.length; index++) {
      if (firstInputs[index].classList.contains("d-none")) {
        firstInputs[index].classList.remove("d-none");
      }
      if (!secondInputs[index].classList.contains("d-none")) {
        secondInputs[index].classList.add("d-none");
      }
    }
  }
  if (element.value == "part_amount_paid") {
    for (let index = 0; index < firstInputs.length; index++) {
      if (!firstInputs[index].classList.contains("d-none")) {
        firstInputs[index].classList.add("d-none");
      }
      if (secondInputs[index].classList.contains("d-none")) {
        secondInputs[index].classList.remove("d-none");
      }
    }
  }
  if (element.value == "not_at_all") {
    for (let index = 0; index < firstInputs.length; index++) {
      if (!firstInputs[index].classList.contains("d-none")) {
        firstInputs[index].classList.add("d-none");
      }
      if (!secondInputs[index].classList.contains("d-none")) {
        secondInputs[index].classList.add("d-none");
      }
    }
  }
}

var request;
//! start of delete product ajax request getdata!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$(".delete-button").click(function (event) {
  event.preventDefault();
  const id = $(this).data("id");
  document.getElementById("request_id_delete").value = id;
});

//! start of delete product ajax request getdata!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

//! start of delete product ajax request postdata!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$("#deleteform").submit(function (event) {
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var deleteForm = $(this);
  var inputs = deleteForm.find("input, select, button, textarea");
  var serializedData = deleteForm.serialize();
  inputs.prop("disabled", true);
  const urlToPostData = "php/request.php";
  const method = "post";
  request = $.ajax({
    url: urlToPostData,
    type: method,
    data: serializedData,
  });
  request.done(function (response, textStatus, jqXHR) {
    $("#staticBackdropDelete").modal("hide");
    location.reload();
  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
  request.always(function () {
    inputs.prop("disabled", false);
  });
});
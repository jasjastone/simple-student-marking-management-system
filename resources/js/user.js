$(".delete-user-button-first").click(function (event) {
  event.preventDefault();
  const id = $(this).data("id");
  const urlToPostData = "php/handleusermanagement.php";
  const method = "post";
  request = $.ajax({
    url: urlToPostData,
    type: method,
    data: { "get-user-details": true, student_id: id },
  });
  request.done(function (response, textStatus, jqXHR) {
    $("#staticBackdropDelete").modal("hide");
    const res = JSON.parse(response);
    const user = JSON.parse(res['user']);
    const role = JSON.parse(res['role']);
    const roles = JSON.parse(res['roles']);
    for (let index = 0; index < roles.length; index++) {
      const element = roles[index];
    }
    document.getElementById("fullname").textContent =
      user['fname'] + " " + user['mname'] + " " + user['lname'];
    document.getElementById("userrole").textContent = role;
    document.getElementById("student_id").value = id;
  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
});
$(".edit-user-button-first").click(function (event) {
  event.preventDefault();
  const id = $(this).data("id");
  const urlToPostData = "php/handleusermanagement.php";
  const method = "post";
  request = $.ajax({
    url: urlToPostData,
    type: method,
    data: { "get-user-details": true, student_id: id },
  });
  request.done(function (response, textStatus, jqXHR) {
    const res = JSON.parse(response);
    document.getElementById("fullname").textContent =
      res['user']['fname'] + " " + res[0][2] + " " + res[0][3];
    document.getElementById("userrole").textContent = res[1];
    document.getElementById("student_id").value = id;
  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
});

$("#deleteForm").submit(function (event) {
  event.preventDefault();
  var deleteForm = $(this);
  var inputs = deleteForm.find("input");
  var serializedData = deleteForm.serialize();
  inputs.prop("disabled", true);
  const urlToPostData = "php/handleusermanagement.php";
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
$("#editForm").submit(function (event) {
  event.preventDefault();
  const urlToPostData = "php/handleusermanagement.php";
  var inputs = this.find("input,select,")
  const method = "post";
  request = $.ajax({
    url: urlToPostData,
    type: method,
    data: { "edit-user-button": true },
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

function check_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "set_done",
    },
    success: function () {
      get_data();
      completed_data();
      completed_count();
    },
  });
}

function uncheck_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "uncheck",
    },
    success: function () {
      get_data();
      completed_data();
      completed_count();
    },
  });
}

function delete_task(task_id) {
  var conf = confirm("Are you sure?");
  if (conf) {
    $.ajax({
      url: "sv_task.php",
      method: "POST",
      data: {
        id: task_id,
        act: "deleteTask",
      },
      success: function (result) {
        get_data();
        completed_data();
      },
    });
  }
}

function get_data() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "loading",
    },
    success: function (result) {
      $("#active_tasks").html(result);
    },
  });
}

function completed_data() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "completed",
    },
    success: function (result) {
      $("#completed_tasks").html(result);
    },
  });
}

function completed_count() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "completed_count",
    },
    success: function (result) {
      $("#completed_count").html(result);
    },
  });
}

function edit_task(id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: id,
      act: "editTask",
    },
    success: function (result) {
      var data = result.split("|");
      $("#edit_task_name").val(data[1]);
      $("#edit_task_desc").val(data[2]);
      $("#edit_category_id").val(data[3]);
      $("#edit_priority_id").val(data[4]);
      $("#edit_task_date").val(data[5]);
      $("#edit_task_time").val(data[6]);
      $("#task_id").val(data[7]);

      $(".overlayUpdate").css("visibility", "visible");
      $(".overlayUpdate").css("opacity", 1);
    },
  });
}

function update_task() {
  // console.log(document.getElementById("edit_task_time").value);
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      task_name: $("#edit_task_name").val(),
      task_desc: $("#edit_task_desc").val(),
      category_id: $("#edit_category_id").val(),
      priority_id: $("#edit_priority_id").val(),
      task_date: $("#edit_task_date").val(),
      task_time: $("#edit_task_time").val(),
      id: $("#task_id").val(),
      act: "updateTask",
    },
    success: function () {
      alert("Data berhasil diubah!");
      get_data();
      completed_data();
      $(".overlayUpdate").css("visibility", "hidden");
      $(".overlayUpdate").css("opacity", 0);
    },
  });
}

$(".close").on("click", function () {
  $(".overlayUpdate").css("visibility", "hidden");
  $(".overlayUpdate").css("opacity", 0);
  window.location = "#";
});

function save_task() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      task_name: $("#task_name").val(),
      task_desc: $("#task_desc").val(),
      category_id: $("#category_id").val(),
      priority_id: $("#priority_id").val(),
      task_date: $("#task_date").val(),
      task_time: $("#task_time").val(),
      act: "saveTask",
    },
    success: function () {
      alert("Data berhasil disimpan!");
      get_data();
      completed_data();
      window.location = "#";
      $("#resetform")[0].reset();
    },
  });
}

function filter_task() {
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  var filter_status = $("#filter_status").val();
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "filter",
      start_date: start_date,
      end_date: end_date,
      filter_status: filter_status,
    },
    success: function (result) {
      $("#filter_result").html(result);
    },
  });
}

function edit_profile(id) {
  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    data: {
      id: id,
      act: "editProfile",
    },
    success: function (result) {
      var data = result.split("|");
      $("#fullname").val(data[1]);
      $("#email").val(data[2]);
      $("#user_id").val(data[3]);
    },
  });
}

function update_profile() {
  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    data: {
      fullname: $("#fullname").val(),
      email: $("#email").val(),
      oldpass: $("#oldpass").val(),
      newpass: $("#newpass").val(),
      id: $("#user_id").val(),
      act: "updateProfile",
    },
    success: function (result) {
      var data = result.split("|");

      var actionType = data[1];
      alert(data[2]);

      if (actionType == "updateProfilePassword") {
        window.location = "logout.php";
      } else if (actionType == "wrongPassword") {
        $("#newpass").val("");
        $("#oldpass").val("");
      }
    },
  });
}

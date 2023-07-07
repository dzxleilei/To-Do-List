function check_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "set_done",
    },
    success: function (result) {
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
    success: function (result) {
      get_data();
      completed_data();
      completed_count();
    },
  });
}

function delete_task(task_id) {
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

      $(".overlayUpdate").css("visibility", "visible");
      $(".overlayUpdate").css("opacity", 1);
    },
  });
}

$(".close").on("click", function () {
  $(".overlayUpdate").css("visibility", "hidden");
  $(".overlayUpdate").css("opacity", 0);
});

function save_task() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      task_name: $("#task_name").val(),
      task_desc: $("#task_desc").val(),
      task_date: $("#task_date").val(),
      act: "saveTask",
    },
    success: function () {
      alert("data berhasil disimpan");
    },
  });
}

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
    },
  });
}

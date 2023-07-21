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
      pet_phases();
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
      pet_phases();
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
      reminder_number: $("#reminder_number").val(),
      reminder_unit: $("#reminder_unit").val(),
      task_date: $("#task_date").val(),
      task_time: $("#task_time").val(),
      collaborators: $("#collaborators").val(),
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

function alarm_trigger() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "alarmTrigger",
    },
    success: function (response) {
      // $row is passed from the server-side response
      var $row = response.row;

      if ($row > 0) {
        // Mengecek apakah fitur Autoplay didukung oleh peramban
        function isAutoplaySupported() {
          // Periksa apakah peramban mendukung fitur Autoplay
          return "autoplay" in document.createElement("audio");
        }

        // Memainkan ringtone
        function playRingtone() {
          var ringtone = new Audio("assets/sounds/alarm.mp3");
          ringtone.play();
        }

        // Fungsi untuk memulai pemutaran ringtone setelah interaksi pengguna
        function startAutoplay() {
          if (isAutoplaySupported()) {
            playRingtone();
          } else {
            // Jika Autoplay tidak didukung, tampilkan pesan untuk mengingatkan pengguna
            alert(
              "Reminder: Please enable autoplay for this site to hear the ringtone."
            );
          }
        }

        // Menambahkan event listener untuk deteksi interaksi pengguna
        window.addEventListener("load", function () {
          startAutoplay();
        });

        // Memulai pemutaran otomatis saat halaman dimuat
        startAutoplay();
      }
    },
    error: function (xhr, status, error) {
      console.log("AJAX Error: " + error);
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
      $("#pet_dropdown").val(data[4]);
    },
  });
}

function update_profile() {
  var form_data = new FormData();

  // Cek apakah ada file foto profil yang dipilih
  if ($("#profile_image").prop("files").length > 0) {
    var file_data = $("#profile_image").prop("files")[0];
    form_data.append("photo", file_data);
  }

  form_data.append("fullname", $("#fullname").val());
  form_data.append("email", $("#email").val());
  form_data.append("oldpass", $("#oldpass").val());
  form_data.append("newpass", $("#newpass").val());
  form_data.append("newpet", $("#pet_dropdown").val());
  form_data.append("id", $("#user_id").val());
  form_data.append("act", "updateProfile");

  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    contentType: false,
    processData: false,
    data: form_data,
    success: function (result) {
      // try {
      var data = result.split("|");
      var actionType = data[1];
      var message = data[2];
      alert(message);
      window.location = "profile.php";

      if (actionType == "updateProfilePassword") {
        window.location = "logout.php";
      } else if (actionType == "wrongPassword") {
        $("#new_password").val("");
        $("#old_password").val("");
      }
      // } catch (error) {
      //   // console.error("Error parsing JSON:", error);
      // }
    },
    error: function () {
      $("#err").html("Terjadi kesalahan pada server.").fadeIn();
    },
  });
}

function pet_phases() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "pet_phases",
    },
    success: function (result) {
      $("#pet_phases").html(result);
    },
  });
}

<!-- Add Task -->
<div class="overlayAdd" id="divAdd">
  <div class="wrapper_add_task">
    <p class="title_add_task"><b>Add New Task</b></p>
    <div class="close">&times;</div>
    <div class="content_add_task">
      <div class="container_add_task">
        <form id="resetform">
          <div class="inputForm2">
            <div>
              <h3>Title</h3>
              <div class="inputForm">
                <input class="textField" type="text" name="task_name" value="" id="task_name"
                  placeholder="Add Task Title..." required />
              </div>
            </div>
            <div class="inputForm">
              <h3>Category</h3>
              <div class="textField">
                <select class="selectCustom" name="category_id" id="category_id">
                  <option value="" selected disabled>Select Category</option>
                  <option value="1">Study</option>
                  <option value="2">Sport</option>
                  <option value="3">Meeting</option>
                  <option value="4">Medic</option>
                </select>
                <span class="arrow"></span>
              </div>
            </div>
          </div>
          <div class="inputForm_date">
            <div class="inputForm">
              <h3>Due Date</h3>
              <div class="inputForm2">
                <input class="textField" type="date" name="task_date" id="task_date"
                  value="<?php echo date('Y-m-d'); ?>">
                <input class="textField" type="time" name="task_time" id="task_time">
              </div>
            </div>
          </div>
          <div class="inputForm2">
            <div>
              <h3>Description</h3>
              <div class="inputForm">
                <input class="textField" type="text" name="task_desc" value="" id="task_desc"
                  placeholder="Add Task Description..." />
              </div>
            </div>
            <div>
              <div>
                <h3>Priority</h3>
                <div class="textField">
                  <select class="selectCustom" name="priority_id" id="priority_id">
                    <option value="" selected disabled>Select Priority</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                  </select>
                  <span class="arrow"></span>
                </div>
              </div>
            </div>
          </div>
          <h3>Reminder</h3>
          <div class="inputForm2">
            <div>
              <div class="textField">
                <input class="selectCustom" type="number" name="reminder_number" id="reminder_number"
                  placeholder="Type number" />
              </div>
            </div>
            <div>
              <div class="textField">
                <select class="selectCustom" name="reminder_unit" id="reminder_unit">
                  <option value="" selected disabled>Select Reminder</option>
                  <option value="1">Minute(s)</option>
                  <option value="2">Hour(s)</option>
                  <option value="3">Day(s)</option>
                </select>
                <span class="arrow"></span>
              </div>
            </div>
          </div>
          <input type="hidden" name="status_id" class="id form-control" id="status_id" value="">
          <div class="inputForm">
            <h3 class="collaborator_title">Collaborator</h3>
            <div class="textField">
              <select class="js-example-basic-multiple selectCustom" name="collaborators[]" multiple="multiple"
                id="collaborators">
                <option class="option" value="" selected disabled>Add collaborator</option>
                <?php
                $user_id = $_SESSION['id'];
                $sqlCollab = "SELECT id, username FROM tb_users WHERE id != '$user_id'";
                $queryCollab = mysqli_query($conn, $sqlCollab);
                while ($resultCollab = mysqli_fetch_array($queryCollab)) {
                  ?>
                  <option value="<?php echo $resultCollab['id'] ?>"><?php echo $resultCollab['username'] ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="button_add_tasks">
            <center>
              <td colspan="2"><input class="button_add_task" type="button" value="Add Task" name="submit"
                  onclick="save_task()"></td>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Task -->
<div class="overlayUpdate" id="divUpdate">
  <div class="wrapper_update_task">
    <p class="title_update_task"><b>Edit Task</b></p>
    <input type="hidden" name="task_id" id="task_id">
    <div class="close">&times;</div>
    <div class="content_update_task">
      <div class="container_update_task">
        <h3>Title</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="edit_task_name" id="edit_task_name" placeholder="Add Task Title..."
            required />
        </div>
        <h3>Description</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="edit_task_desc" id="edit_task_desc"
            placeholder="Add Task Description..." />
        </div>
        <div class="inputForm_date">
          <div class="inputForm">
            <h3>Due Date</h3>
            <div class="inputForm">
              <input class="textField" type="date" name="task_date" id="edit_task_date">
              <input class="textField" type="time" name="task_time" id="edit_task_time">
            </div>
          </div>
        </div>
        <div class="inputForm">
          <h3>Category</h3>
          <div class="customSelect">
            <select name="edit_category_id" id="edit_category_id">
              <option value="" selected disabled>Select Category</option>
              <option value="1">Study</option>
              <option value="2">Sport</option>
              <option value="3">Meeting</option>
              <option value="4">Medic</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="inputForm">
          <h3>Priority</h3>
          <div class="customSelect">
            <select name="edit_priority_id" id="edit_priority_id">
              <option value="" selected disabled>Select Priority</option>
              <option value="1">Low</option>
              <option value="2">Medium</option>
              <option value="3">High</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="button_update_tasks">
          <center>
            <td colspan="2"><input class="button_add_task" id="button_edit_task" type="button" value="Update Task"
                name="submit" onclick="update_task()"></td>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
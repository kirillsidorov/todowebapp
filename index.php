<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/myjs.js"></script>
    <title></title>
</head>
<body>
    <header>
        <div class="container">
            <div class="row"></div>
                <div id="header" class="col-sm-12 text-center">
                    <h1> Simple Todo Lists</h1>
                    <h2>From ruby garage</h2>
                </div>
            </div>
        </div>
    </header>

    <div class="container" id="project" style="margin-top: 30px"></div>
    <footer>
        <div class="jumbotron text-center" style="margin-bottom:0;">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddNewProject">
             Add New Project
           </button>
        </div>
    </footer>

<!--Update Task Modal-->
<div class="modal" id="update">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Edit Task</h3>
          </div>
          <div class="modal-body">
          <p id="up-message" class="text-dark"></p>
            <form>
              <input type="hidden" class="form-control my-2" placeholder="Task" id="Up_Task_ID">
              <input type="text" class="form-control my-2" placeholder="Task Content" id="Up_Task_Content">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn_edit_task_modal">Update Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div>

<!--Delete Task Modal-->
<div class="modal" id="delete_task">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Delete Task?</h3>
          </div>
          <div class="modal-body">
            <p id="up-message" class="text-dark"></p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn_delete_task_modal">Delete Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal Add Project-->
<div class="modal" id="AddNewProject">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Create Project</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="needs-validation" novalidate>
            <label for="project_name">Project Name:</label>
            <input type="text" class="form-control" placeholder="Enter Project Name" id="project_name" required>
            <button type="submit" class="btn btn-primary"  id="btn_add_project">Submit</button>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- The Modal Edit Project -->
<div class="modal" id="EditProject">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit Project</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="needs-validation" novalidate>
            <label for="project_name">Project Name:</label>
            <input type="text" class="form-control" placeholder="Enter Project Name" id="project_name_edit" required>
            <button type="submit" class="btn btn-primary"  id="btn_edit_project_modal">Submit</button>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// Disable form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>
</body>
</html>
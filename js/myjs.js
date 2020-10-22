$(document).ready(function()
{
    view_records();
    insert_project();
    delete_project();
    edit_project();
    add_task();
    delete_task();
    get_task();
    edit_task();
    status_task();
    add_task_btn();
})

// Insert Project in the Database
function insert_project(){
   $(document).on('click','#btn_add_project',function()
   {
        var ProjectName = $('#project_name').val();
        $.ajax(
                {
                    url : 'createproject.php',
                    method: 'post',
                    data:{PName:ProjectName},
                    success: function(data){
                        $('#project').html(data);
                        view_records();
                    }
                })
   })

   $(document).on('click','#btn_close',function()
   {
       $('form').trigger('reset');
       $('#message').html('');
   })   
}

// Update Project Name 
function edit_project(){
    $(document).on('click','#btn_edit_project',function(){
        var ProjectId = $(this).attr('data-id1');
        var str = "Project"+ProjectId;
        var ProjectName = document.getElementById(str).innerText;
        console.log('Project Name = ' + ProjectName);
        console.log('Project ID = ' + ProjectId);
        $('#project_name_edit').val(ProjectName);

        $(document).on('click','#btn_edit_project_modal',function(){
            
            var ProjectName = $('#project_name_edit').val();
            
            console.log('Project ID' + ProjectId);
            console.log('Project Name' + ProjectName);

            if(ProjectName == "" || ProjectId == "")
            {
                $('#up-message').html('please Fill in the Blanks');
                $('#update').modal('show');
                console.log("please Fill in the Blanks");
            }else{
                $.ajax(
                    {
                        url: 'editproject.php',
                        method: 'post',
                        data:{PId:ProjectId,
                            PName:ProjectName},
                        success: function(data){
                                $('#project').html(data.html);
                                view_records();
                        }
                    })
            }
        });
    });
}

var Project_Id;
// Delete Project Function
function delete_project(){
    $(document).on('click','#btn_delete_project',function(){
        Project_Id = $(this).attr('data-id1');
        var str = "Project"+Project_Id;
        var ProjectName = document.getElementById(str).innerText;
        document.getElementById('up-message').innerText = ProjectName;
        $('#up-message').html(ProjectName);
        $(document).on('click','#btn_delete_project_modal',function()
        {
            $.ajax({
                url: 'deleteproject.php',
                method: 'post',
                data:{PId:Project_Id},
                success: function(data){
                        $('#project').html(data.html);
                        view_records();
                        $('#delete_project').modal('hide');
                        console.log('success');
                }
            });
            console.log('good')

        });
            });
}



var ProjectId;
function add_task_btn(){
    $(document).on('click','#btn_add_task',function(){
        ProjectId = $(this).attr('data-id1');
        console.log(ProjectId);
    });
}

// Insert Task 

function add_task(){
        $(document).on('click','#btn_add_task_modal',function(){

            //var ProjectIdModal = $('#Create_Project_ID').val();
            var TaskContent = $('#Create_Task_Content').val();
            var TaskPriority = $('#priority1').val();
            var TaskDeadline = $('#datepicker1').val();
            console.log(" ProjectId -" + ProjectId + " TaskContent - " +TaskContent + " - " + TaskPriority +" - " + TaskDeadline);

            if(TaskContent != ""){
                $.ajax({
                        url : 'inserttask.php',
                        method: 'post',
                        data:{PId:ProjectId,
                            TContent:TaskContent,
                            TPriority:TaskPriority,
                            TDeadline:TaskDeadline},
                        success: function(data){
                            $('#project').html(data.html);
                            $('#Create_Project_ID').val('');
                            $('input[type="text"],textarea').val('');
                            $('#create').modal('hide');
                            view_records();
                        }
                    })
            }
        })
    }

//Edit Task
function edit_task(){
    $(document).on('click','#btn_edit_task_modal',function(){
        var TaskId = $('#Up_Task_ID').val();
        var TaskContent = $('#Up_Task_Content').val();
        var TaskPriority = $('#priority').val();
        var TaskDeadline = $('#datepicker').val();

        //console.log(TaskId + " - " +TaskContent + " - " + TaskPriority +" - " + TaskDeadline);

        if(TaskContent !=''){
            $.ajax({
                    url: 'edittask.php',
                    method: 'post',
                    data:{TId:TaskId,
                        TContent:TaskContent,
                        TPriority:TaskPriority,
                        TDeadline:TaskDeadline},
                        success: function(data){
                            $('#project').html(data.html);
                            $('#up-message').html(data);
                            $('#update').modal('show');
                            view_records();
                        }
                    
                    })
        }
   })
}

//Delete Task
var TaskId;
function delete_task(){
    $(document).on('click','#btn_delete_task',function(){
        TaskId = $(this).attr('data-id');
        console.log('TaskId = ' + TaskId);
        
        $(document).on('click','#btn_delete_task_modal',function()
        {
                    $.ajax({
                        url : 'deletetask.php',
                        method: 'post',
                        data:{TId:TaskId},
                        success: function(data){
                            $('#project').html(data.html);
                            $('#delete_task').modal('hide');
                            view_records();
                        }
                    })
                    
        })
        
    
})
}

// Display All projects and Tasks
function view_records()
{
    $.ajax(
        {
            url: 'view.php',
            method: 'post',
            success: function(data)
            {
                data = $.parseJSON(data);
                if(data.status=='success')
                {
                    $('#project').html(data.html);
                }
            }
        })
}


//Get Task
function get_task(){
    $(document).on('click','#btn_edit_task',function(){
        
        var ID = $(this).attr('data-id');
        //console.log(ID);
        
        $.ajax(
            {
                url: 'gettask.php',
                method: 'post',
                data:{TId:ID},
                dataType: 'JSON',
                success: function(data)
                {
                   $('#Up_Task_ID').val(data[0]);
                   $('#Up_Task_Content').val(data[1]);
                   $('#datepicker').val(data[2]);
                   $('#priority').val(data[3]);
                   $('#update').modal('show');
                   
                }
                
            })
    })
}

//Change task status
function status_task(){
    $(document).on('click','#chb',function(){
        var status = $(this).attr('job');
        var TaskId = $(this).attr('data-id');

        if(status == 'in_progress'){
            console.log('task complete');
            $.ajax(
                {
                    url: 'statustask.php',
                    method: 'post',
                    data:{TId:TaskId, TStatus:0},
                    success: function(data)
                    {
                        $('#project').html(data.html);
                        view_records();
                    }
                    
                })   
        }else{
            console.log('task in progress');
            $.ajax(
                {
                    url: 'statustask.php',
                    method: 'post',
                    data:{TId:TaskId, TStatus:1},
                    success: function(data)
                    {
                        $('#project').html(data.html);
                        view_records();
                    }
                    
                })
        }
    })
}







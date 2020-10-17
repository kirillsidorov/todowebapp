$(document).ready(function()
{
    view_records();
    insert_project();
    delete_project();
    update_project();
    add_task();
    delete_task();
    get_task();
    edit_task();
    status_task();
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
function update_project(){
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

// Delete Project Function
function delete_project(){
    $(document).on('click','#btn_delete_project',function(){
        var Project_Id = $(this).attr('data-id1');
        $.ajax({
                url: 'deleteproject.php',
                method: 'post',
                data:{PId:Project_Id},
                success: function(data){
                        $('#project').html(data.html);
                        view_records();
                        console.log('success');
                }
            })
            console.log('good')
    })
}

// Insert Project in the Database
function add_task(){
    $(document).on('click','#btn_add_task',function(){
        
        var ProjectId = $(this).attr('data-id1');
        
        //console.log('ProjectId ' + ProjectId);
        var f = '#form-' + ProjectId; 
        var TaskContent = $(f).val();
        
        //console.log('Content ' + TaskContent);
        
         if(TaskContent != ""){
            $.ajax(
                 {
                     url : 'inserttask.php',
                     method: 'post',
                     data:{TContent:TaskContent,
                            PId:ProjectId},
                     success: function(data){
                         $('#project').html(data);
                         view_records();
                     }
                 })
        }
    })
 }


function delete_task(){
    $(document).on('click','#btn_delete_task',function(){
        
        console.log('pushed btn_delete_task ');

        var TaskId = $(this).attr('data-id');

        console.log('TaskId = ' + TaskId);
        
        if(TaskId != ""){
            $.ajax(
                 {
                     url : 'deletetask.php',
                     method: 'post',
                     data:{TId:TaskId},
                     success: function(data){
                         $('#project').html(data.html);
                         view_records();
                     }
                 })
        }
    })
}

// Display Record
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

function edit_task(){
    $(document).on('click','#btn_edit_task_modal',function(){
        var TaskId = $('#Up_Task_ID').val();
        var TaskContent = $('#Up_Task_Content').val();
        
        console.log(TaskContent + ' ' + TaskId);

        if(TaskContent !=''){
            $.ajax(
                {
                    url: 'edittask.php',
                    method: 'post',
                    data:{TId:TaskId,TContent:TaskContent},
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

//Get Particular Record
function get_task(){
    $(document).on('click','#btn_edit_task',function(){
        
        var ID = $(this).attr('data-id');
        console.log(ID);
        
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
                   $('#update').modal('show');
                   
                }
                
            })
    })
}

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





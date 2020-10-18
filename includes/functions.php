<?php 

    require_once('connection.php');

    // Insert Record Function
    function InsertRecord()
    {
        global $con;
        $UserName = $_POST['UName'];
        $UserEmail = $_POST['UEmail'];
        
        $query = " insert into user_record (UserName,UserEmail) values('$UserName','$UserEmail')";
        $result= mysqli_query($con,$query);

        if($result)
        {
            echo ' Your Record Has Been Saved in the Database';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

    // Create Project Function
    function CreateProject()
    {
        global $con;
        $ProjectName = $_POST['PName'];
        
        $query = "insert into `projects` (Name) values('$ProjectName')";
        $result= mysqli_query($con,$query);

        if($result)
        {
            echo ' Your Record Has Been Saved in the Database';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

    // Delete Project Function
    function DeleteProject()
    {
        global $con;
        $Project_Id = $_POST['PId'];

        $query = "delete from `projects` where Id='$Project_Id' ";
        $result = mysqli_query($con,$query);

        if($result)
        {
            echo ' Your Record Has Been Delete ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

    // Edit Project Name Function
    function EditProject()
    {
        global $con;
        $Project_Id = $_POST['PId'];
        $Project_Name = $_POST['PName'];
        $query = "update `projects` set `Name`='$Project_Name'  where Id='$Project_Id' ";

        if($Project_Id != "" || $Project_Name != ""){
            $result = mysqli_query($con,$query);
        }

        if($result)
        {
            echo ' Your Record Has Been Update ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }


    // Display Data Function
    function display_record()
    {
        global $con;
        $value = '';

        $query = "select * from projects ";
        $result = mysqli_query($con,$query);
        
        while($row=mysqli_fetch_assoc($result)){

            $value.= '<div class="container border rounded gradient" style="padding-bottom: 10px; margin-bottom: 10px;">
                    <div class="container border rounded" style="margin-top:30px;">
                        <div class="row bg-primary text-white">
                            <div class="col-10" id="Project'.$row['Id'].'">'.$row['Name'].'</div>
                            <div class="col-1">
                                <button class="btn btn-success" id="btn_edit_project" data-id1='.$row['Id'].' data-toggle="modal" data-target="#EditProject"><span class="fa fa-edit"></button>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger" id="btn_delete_project" data-id1='.$row['Id'].'><span class="fa fa-trash"></button>  
                            </div>     
                        </div>
                    </div>
                    <div class="container" style="margin-top: 5px;margin-bottom:5px">
                        <div class="row">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Some task.." id="form-'.$row['Id'].'" data-id1='.$row['Id'].' required>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btn_add_task" data-id1='.$row['Id'].' >Add Task</button>
                                </div>
                            </div>
                        </div>
                    </div>';
            
            $value.= get_tasks_by_projectId($row['Id']);
            $value.= '</div>';
        }
        $value.='</div>';
        echo json_encode(['status'=>'success','html'=>$value]);
    }

function get_tasks_by_projectId($id){
    global $con;
    $html = '';
    $sql = 'select * from `tasks` WHERE ProjectId = '.$id;
    $res = mysqli_query($con,$sql);
    while($row1=mysqli_fetch_assoc($res)){
            $html.= '<div class="container border rounded bg-light" style="border-bottom: 1px; margin-top: 10px;">
                         <div class="row">
                            <div class="col-1" >
                                <div class="form-check-inline">
                                    <label class="form-check-label">';
                                    if($row1['CheckStatus'] == 0){
                                        $html.=     '<input type="checkbox" class="form-check-input" id="chb" job="complete" data-id='.$row1['Id'].' value="" checked>
                                    </label>
                                </div>
                             </div>
                            <div class="col-9" ><p class="text lineThrough">'.$row1['Content'].'</p></div>';
                                    }else{
                                        $html.=    '<input type="checkbox" class="form-check-input" id="chb" job="in_progress" data-id='.$row1['Id'].' value="">
                                    </label>
                                </div>
                             </div>
                            <div class="col-9" ><p class="text">'.$row1['Content'].'</p></div>';
                                    }
                                    
                            $html.='<div class="col-1" > 
                                <button class="btn btn-success" id="btn_edit_task" data-id='.$row1['Id'].'><span class="fa fa-edit"></span></button>
                            </div>
                            <div class="col-1" >
                                <button class="btn btn-danger" id="btn_delete_task" data-id='.$row1['Id'].' data-toggle="modal" data-target="#delete_task"><span class="fa fa-trash"></span></button>
                            </div>
                        </div>
                    </div>';
            }
    return $html;
}

function insert_task_by_projectId(){
    global $con;
    $Project_Id = $_POST['PId'];
    $Task_Content = $_POST['TContent'];

    $query = "insert into `tasks` (`Content`, `ProjectId`, `CheckStatus`) values ('$Task_Content', '$Project_Id', '1')";

    if($Project_Id != "" || $Task_Content != ""){
        $result = mysqli_query($con,$query);
    }

    if($result)
    {
        echo ' Your Record Has Been Insert ';
    }
    else
    {
        echo ' Please Check Your Query ';
    }
}


    // Get Particular Record
    function get_task_by_id()
    {
        global $con;
        $TaskId = $_POST['TId'];
        $query = "select * from tasks where Id='$TaskId'";
        $result = mysqli_query($con,$query);

        while($row=mysqli_fetch_assoc($result))
        {
            $json = array(
                $row['Id'],
                $row['Content']
            );
        }
        echo json_encode($json);
    }

    // Update Function
    function EditTask()
    {
        global $con;
        $TaskId = $_POST['TId'];
        $TaskContent =$_POST['TContent'];

        $query = "update tasks set `Content` = '$TaskContent' where Id='$TaskId '";
        $result = mysqli_query($con,$query);
        if($result)
        {
            echo ' Your Record Has Been Updated ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

    function delete_task_by_Id(){
        global $con;
        
        $Task_Id = $_POST['TId'];
        $query = "delete from tasks where Id='$Task_Id' ";
        $result = mysqli_query($con,$query);

        if($result)
        {
            echo ' Your Record Has Been Delete ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

    function StatusTask(){
        global $con;
        $TaskId = $_POST['TId'];
        $TaskStatus =$_POST['TStatus'];

        $query = "update tasks set `CheckStatus` = '$TaskStatus' where Id='$TaskId '";
        $result = mysqli_query($con,$query);
        if($result)
        {
            echo ' Your Record Has Been Updated ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }

    }


?>






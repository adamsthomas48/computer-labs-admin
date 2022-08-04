<h2><?php echo $selectedLab->getName(); ?></h2>
<form action="" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Employee Name</label>
        <input type="text" class="form-control" id="employee-name" name="employee-name" aria-describedby="name" placeholder="Enter Employee Name">
    </div>
    <?php foreach($selectedTodos as $k => $todo) {
            if($selectedLab->setDisplay($todo)){
        ?>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="<?php echo $todo["id"]; ?>" name="check_list[]">
            <label class="form-check-label" for="exampleCheck1"><?php echo $todo["short_name"];?></label>
        </div>
    <?php }} ?>
    <div class="mt-4"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
</form>

<?php
    if(isset($_POST['submit'])) {
        $employeeName = $_POST['employee-name'];
        $checked_todos = $_POST['check_list'];
        echo $employeeName;
        echo " " . getUserIpAddr();

        $selectedLab->postSubmission($employeeName, getUserIpAddr(), $checked_todos);
    }

    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

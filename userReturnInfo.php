    <?php 
    require "db.php";
    $sql="SELECT * FROM users ";
    $result=mysqli_query($con,$sql);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            a{padding:14px 28px;
                color:white;
                background-color:red;
                text-align:center;
            text-decoration:none;
        }
    
        </style>
    </head>
    <body>
        <table style="width:100%;">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>First Name</th>
            </tr>
        
        <?php while($user=mysqli_fetch_assoc($result)) {?>
            
            <tr>
                <td><?php echo $user["username"]; ?></td> 
                <td><?php echo $user["email"]; ?></td>
                <td><?php echo $user["firstName"]; ?></td>
            </tr>
            
                  <?php }  ?>
        
                </table>
            <br><br>
            <a href="admin.php"> Go back to admin page</a> 
            <a href="addPage.php">Add User</a>


            
    </body>
    </html>
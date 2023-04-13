<?php 


    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "onlinecourse";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysqli_error());
        }

    if(isset($_POST['register']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $image = $_FILES['image']['name'];
        $file = $_FILES['file']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $address = $_POST['address'];

        move_uploaded_file($image_tmp,"images/$image");
        move_uploaded_file($file_tmp,"images/$file");

       

        $query = "insert into applications (name,email,image,file,address) values ('$name','$email','$image','$file','$address')";

        $result = mysqli_query($conn, $query);

        if($result==1)
        {       

            header("location:http://localhost/mentor/application/index.php");
        
        }
        else {       

        echo "Insertion Failed";

             }
    }
?>
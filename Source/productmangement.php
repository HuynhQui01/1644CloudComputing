<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <?php
    include_once './connectDB.php';
    $c = new Connect();
    $dblink = $c->connectToPDO();


    if (isset($_POST['add'])) {
        $pID = $_POST['txtPID'];
        $pName = $_POST['txtPName'];
        $catID = $_POST['txtCateID']??"";
        $price = $_POST['txtPPrice'];
        $supID = $_POST['txtSupID'];
        $storeID = $_COOKIE['storeID'];
        $quan = $_POST['txtQuan'];
        $address = $_COOKIE['address'];
        $uID = $_COOKIE['uID'];
        $date = date('Y-m-d');

        if (($_FILES['txtImage']['name'] != "")) {
            // Where the file is going to be stored
            $target_dir = "./Image/";
            $file = $_FILES['txtImage']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['txtImage']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;

            $imgname = $filename . "." . $ext;

            // Check if file already exists
            if (file_exists($path_filename_ext)) {
                echo "Sorry, file already exists.";
            } else {
                move_uploaded_file($temp_name, $path_filename_ext);
                // echo "Congratulations! File Uploaded Successfully.";
            }
        }
        $sql = "INSERT INTO `toys`(`pID`, `pName`, `catID`, `pPrice`, `supID`, `img`) VALUES (?,?,?,?,?,?)";
        $re = $dblink->prepare($sql);
        $stmt = $re->execute(array($pID, $pName, $catID, $price, $supID, $imgname));
        // header("Location:productmangement.php");
        // if($stmt){
        //     echo "Success";
        // } echo print_r($re->errorInfo());

        $storeslq = "INSERT INTO `warehouse`(`storeID`, `pID`, `quantity`, `userID`, `date`) VALUES (?,?,?,?,?)";
        $rest = $dblink->prepare($storeslq);
        $rest->execute(array($storeID,$pID,$quan,$uID,$date));
        // echo print_r($rest->errorInfo());
    }
    ?>
    <nav>
        <div><a href="./home.php"><img src="./Image/Screenshot 2023-06-08 155639.jpg" alt=""></a></div>
        <div>
            <span>Product mangement</span>
        </div>
        <div>

        </div>

    </nav>

    <div class="section">
        <div class="all-product">

            <table class="table">
                <thead>
                    <th>pID</th>
                    <th>pName</th>
                    <th>catID</th>
                    <th>pPrice</th>
                    <th>supID</th>
                    <th>City</th>
                    <th>Date</th>
                </thead>
                <?php
                include_once './connectDB.php';
                $c = new Connect();
                $dblink = $c->connectToPDO();
                $address = $_COOKIE['address']??"";
                $sql = "SELECT t.pID, t.pName, t.catID,t.pPrice,t.supID,warehouse.date FROM `warehouse` INNER JOIN toys as t ON t.pID = warehouse.pID INNER JOIN user AS u ON u.uID = warehouse.userID WHERE u.address LIKE ?";
                $re = $dblink->prepare($sql);
                $re->execute(array("%$address%"));
                $row = $re->fetchAll(PDO::FETCH_BOTH);
                foreach ($row as $r) :
                ?>
                    <tbody>
                        <td><?= $r['pID'] ?></td>
                        <td><?= $r['pName'] ?></td>
                        <td><?= $r['catID'] ?></td>
                        <td><?= $r['pPrice'] ?></td>
                        <td><?= $r['supID'] ?></td>
                        <td><?=$address?></td>
                        <td><?=$r['date']?></td>
                    </tbody>
                <?php
                endforeach;
                ?>
            </table>

        </div>
        <div class="add">
            <span>Add toy</span>
            <form action="" name="register-form" method="POST" class="form-horizontal needs-validation" role="form" enctype="multipart/form-data">
                <div class="row py-3 offset-2">
                    <label for="txtUName" class="col-sm-2 control-label">pID</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtPID" id="" class="form-control" required>
                    </div>
                </div>
                <div class="row py-3 offset-2">
                    <label for="txtPassword" class="col-sm-2 control-label">pName</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtPName" id="" class="form-control" required>
                    </div>
                </div>
                <div class="row py-3 offset-2">
                    <label for="txtPassword" class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtQuan" id="" class="form-control" required>
                    </div>
                </div>
                <div class="row py-3 offset-2">
                    <label for="txtCPw" class="col-sm-2 control-label">CateID</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtCateID" id="" class="form-control" required>
                    </div>
                </div>
                <div class="row py-3 offset-2">
                    <label for="txtAddress" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtPPrice" id="" class="form-control">
                    </div>
                </div>

                <div class="row py-3 offset-2">
                    <label for="txtAddress" class="col-sm-2 control-label">SupID</label>
                    <div class="col-sm-6">
                        <input type="text" name="txtSupID" id="" class="form-control">
                    </div>
                </div>
                <div class="row py-3 offset-2">
                    <label for="txtAddress" class="col-sm-2 control-label">Choose img</label>
                    <div class="col-sm-6">
                        <input type="file" name="txtImage" id="" class="form-control">
                    </div>
                </div>

                <div class="row py-3">
                    <div class="col-sm-3 offset-5">
                        <input type="submit" class="btn btn-primary" name="add" id="btnRegister" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
    include "../superadminpage/common.inc.php";
    include "../db/db_connect.inc.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>History</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="history.css">
</head>

<body>
    <div class="table">
        <h1>Train History Table</h1>
        <section>
        <div class="tab2">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Train Name</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Seat</th>
                            <th>Date</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                    /*pagination*/
                    $rpp1=05;
                    isset($_GET['page'])?$pageno =$_GET['page']:$pageno=0;
                    if($pageno>1){
                        $start1 =($pageno * $rpp1)-$rpp1;
                    }else{
                        $start1=0;
                    }
                    $sqli1="SELECT *FROM train_history";
                    $resultSet1=mysqli_query($conn,$sqli1);
                    $numRows1=mysqli_num_rows($resultSet1);
                    $totalpages1=ceil($numRows1/$rpp1);
                    /*pagination*/
                    $sql = "SELECT train_history.id, train_history.username, train_list.name, train_list.board, train_list.destination, train_history.seat, train_history.date, train_history.payment,train_history.status FROM train_history INNER JOIN train_list ON train_history.train_id = train_list.id LIMIT $start1,$rpp1";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);

                    if ($rowCount > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tbody>
                            <tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['board'] . "</td>
                            <td>" . $row['destination'] . "</td>
                            <td>" . $row['seat'] . "</td>
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['payment'] . "</td>
                            <td>" . $row['status'] . "</td>
                            </tr>
                            </tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo $message = "No History!";
                    }
                    /*pagination*/
                    if($pageno>1)
                    {
                        echo "<a href='?page=".($pageno-1)."' class='btn'>Previous<</a>";
                    }
                    for($x=1;$x <= $totalpages1;$x++){
                        echo "<a href='?page=$x' class='btn'>   $x</a>";
                    }
                    if($x>1)
                    {
                        echo "<a href='?page=".($pageno+1)."' class='btn'>Next></a>";
                    }
                    /*pagination*/
                    ?>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
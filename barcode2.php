<?php 
include "connection.php";
?>

<!-- CONNECT DB TABLE FROM PHPMYADMIN -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JSON ENCODE</title>

    </head>
    <body>
        <!-- PHP CODE FETCH DATA FROM DB -->
        <?php
            $con = new mysqli('localhost','root','','pm1');
            $query = $con->query("SELECT * FROM employee ORDER BY staff_id ASC");                 

            foreach($query as $data)
            {
                $staff_name[] = $data['staff_name'];
            }
        ?>                                 

        <div>
        <?php 
                $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
                $result = $conn -> query($sql);  
                      
                while($row = $result->fetch_assoc()){ 
                    $complete=0;   
                    $sql2 = "SELECT * FROM project WHERE project_assign='".$row['staff_id']."' AND project_status='1'";                                 
                    $result2 = $conn -> query($sql2);           
                    while($row2 = $result2->fetch_assoc()){ 
                        $complete++;
                  }
                    echo $complete.",";
                }
            ?>
            <canvas id="myChart" style="width: 400px; height: 100px;"></canvas>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100@1.0.0"></script>


    <script>
        Chart.register(ChartjsPluginStacked100.default); //untuk stack100bar
    // setup 
        const labels = <?php echo json_encode($staff_name) ?>;
        const data = {
        labels: labels,
        datasets: [{
            label: 'Completed',
            data: [
            <?php 
                $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
                $result = $conn -> query($sql);  
                      
                while($row = $result->fetch_assoc()){ 
                    $complete=0;   
                    $sql2 = "SELECT * FROM project WHERE project_assign='".$row['staff_id']."' AND project_status='1'";                                 
                    $result2 = $conn -> query($sql2);           
                    while($row2 = $result2->fetch_assoc()){ 
                        $complete++;
                  }
                    echo $complete.",";
                }
            ?>
            ],
            backgroundColor: [
            'rgba(54, 162, 235, 0.2)', 
            ],
            borderColor: [
            'rgb(54, 162, 235)',
            ],
            borderWidth: 1
        },
        {
            label: 'In-Progress',
            data: [
            <?php 
                $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
                $result = $conn -> query($sql);  
                $inprogress=0;         
                while($row = $result->fetch_assoc()){ 
                    $sql2 = "SELECT * FROM project WHERE project_assign='".$row['staff_id']."' AND project_status='2'";                                 
                    $result2 = $conn -> query($sql2);           
                    while($row2 = $result2->fetch_assoc()){ 
                        echo $inprogress++;
                    }
                }
            ?>
            ],
            backgroundColor: [
            'rgba(255, 159, 64, 0.2)', //oren
        ],
            borderColor: [
            'rgb(255, 159, 64)',

            ],
            borderWidth: 1
        },
        {
            label: 'Pending',
            data: [
            <?php 
                $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
                $result = $conn -> query($sql);  
                $pending=0;         
                while($row = $result->fetch_assoc()){ 
                    $sql2 = "SELECT * FROM project WHERE project_assign='".$row['staff_id']."' AND project_status='3'";                                 
                    $result2 = $conn -> query($sql2);           
                    while($row2 = $result2->fetch_assoc()){ 
                        echo $pending++;
                    }
                }
            ?>
            ],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)', //pink -pending            
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            ],
            borderWidth: 1
        },
        {
            label: 'Aborted',
            data: [
            <?php 
                $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
                $result = $conn -> query($sql);  
                $aborted=0;         
                while($row = $result->fetch_assoc()){ 
                    $sql2 = "SELECT * FROM project WHERE project_assign='".$row['staff_id']."' AND project_status='4'";                                 
                    $result2 = $conn -> query($sql2);           
                    while($row2 = $result2->fetch_assoc()){ 
                        echo $aborted++;
                    }
                }
            ?>
            ],
            backgroundColor: [
            'rgba(201, 203, 207, 0.2)' //kelabu
        ],
            borderColor: [
            'rgb(201, 203, 207)'
        ],
            borderWidth: 1
        }]
        };

        const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                stacked100: {
                    enable: true,
                }
            },
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
        };


        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>


</body>
</html>
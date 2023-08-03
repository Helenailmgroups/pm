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
            $query = $con->query("SELECT employee_name FROM employee");                 

            foreach($query as $data)
            {
                 employee_name[] = $data['employee_name'];
            }
            
            $sql = "SELECT * FROM employee ORDER BY staff_id ASC";                                 
            $result = $conn -> query($sql);
 
            if (!$result){
                                                
            die("invalid query: " . $conn->$error);
 
            }                                              
            while($row = $result->fetch_assoc()){ 
              // call dept id name
            //   $project_assign = $row['staff_id'];
 
              $kira=0;
              $sql2 = "SELECT * FROM project WHERE project_assign = ' ". $row['staff_id']." '";
              $result2 = $conn -> query($sql2);
 
              while($row2 = $result2->fetch_assoc()){ 
                $kira++;
              } 
// SECTION 3
            $sql3 = "SELECT * FROM project WHERE project_assign = ' ". $row['staff_id']." ' AND project_status= 1";                                 
            $result3 = $conn -> query3($sql3);
 
            if (!$result){
                                                
            die("invalid query: " . $conn->$error);
 
            }                                              
            while($row3 = $result3->fetch_assoc()){ 
              $status_lengkap=0;
              $sql3 = "SELECT * FROM project WHERE project_assign = ' ". $row['staff_id']." '";
              $result3 = $conn -> query($sql3);
 
              while($row2 = $result2->fetch_assoc()){ 
                $status_lengkap++;
              } 
              
              
        ?>                                 

        <div>
            <canvas id="myChart" style="width: 400px; height: 100px;"></canvas>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100@1.0.0"></script>


    <script>
        Chart.register(ChartjsPluginStacked100.default); //untuk stack100bar
    // setup 
        const labels = <?php echo json_encode($employee_name) ?>;
        const data = {
        labels: labels,
        datasets: [{
            label: 'Completed',
            data: <?php echo json_encode($total) ?>,
            backgroundColor: [
            // 'rgba(255, 99, 132, 0.2)', //pink -pending
            //'rgba(255, 159, 64, 0.2)', //oren
            // 'rgba(255, 205, 86, 0.2)', //oren
            // 'rgba(75, 192, 192, 0.2)', //turquoise - inprogress
            'rgba(54, 162, 235, 0.2)', //biru - completed
            // 'rgba(153, 102, 255, 0.2)', //purple - aborted
            // 'rgba(201, 203, 207, 0.2)' //kelabu
            ],
            borderColor: [
            // 'rgb(255, 99, 132)',
            //'rgb(255, 159, 64)',
            // 'rgb(255, 205, 86)',
            // 'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            // 'rgb(153, 102, 255)',
            // 'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        },
        {
            label: 'In-Progress',
            data: <?php echo json_encode($total) ?>,
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
            data: <?php echo json_encode($total) ?>,
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
            data: <?php echo json_encode($total) ?>,
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

        // === include 'setup' then 'config' above ===

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>


</body>
</html>

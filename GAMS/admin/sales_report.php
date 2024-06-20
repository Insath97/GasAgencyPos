<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');

/// Retrieve data from database
$sql = "SELECT * FROM rpos_orders";
$result = mysqli_query($mysqli, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $productname[]  = $row['prod_name']  ;
    $sales[] = $row['prod_qty'];

}

?>


<body>
    <!-- Sidenav -->
    <?php
    require_once('partials/_sidebar.php');
    ?>
   
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <?php
        require_once('partials/_topnav.php');
        ?>
        <!-- Header -->
        <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
        <span class="mask bg-gradient-dark opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
             <!-- Table -->
             <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            Sales Reports
                        </div> 

                        <script>
window.onload = function() {
 
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
 
}
</script>
    
<canvas  id="chartjs_bar" style="height: 400px; width: 100%;"></canvas> 
                         
  
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php
            require_once('partials/_footer.php');
            ?>
        </div>
        
    </div>
    
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
  
    


</body>
</html>
<?php
@session_start();
require "../common/bootLinks.php";
require "adminSession.php";
require_once "../common/connection.php";
?>



<div class="content">
    <h5 class="mt-4 mb-2">Hi, <?php echo $adminfname ?></h5>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">users</span>
                    <span class="info-box-number"><?php
                                                    echo $reg =  $conn->query("SELECT * FROM user")->num_rows;
                                                    ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?php
                                                                echo $conn->query("SELECT * FROM user")->num_rows;
                                                                ?>%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-train"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Movies</span>
                    <span class="info-box-number"><?php
                                                    echo $comp = $conn->query("SELECT * FROM movie")->num_rows;
                                                    ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?php
                                                                echo $conn->query("SELECT * FROM movie")->num_rows;
                                                                ?>%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-train"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">shows</span>
                    <span class="info-box-number"><?php echo $conn->query("SELECT * FROM movieshow")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $conn->query("SELECT * FROM movieshow")->num_rows ?>%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->



        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-secondary">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Admins</span>
                        <span class="info-box-number"><?php echo $conn->query("SELECT * FROM admin")->num_rows ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $conn->query("SELECT * FROM admin")->num_rows ?>%"></div>
                        </div>
                        <?php //readonly  
                        ?>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fa fa-comment-dots"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Feedbacks Received</span>
                        <span class="info-box-number"><?php echo $conn->query("SELECT * FROM comment ")->num_rows; ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $conn->query("SELECT * FROM comment ")->num_rows; ?>%"></div>
                        </div>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-dollar-sign"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">show total balance</span>
                        <span class="info-box-number"> <?php
                                                        $row = $conn->query("SELECT SUM(balance) AS amount FROM user")->fetch_assoc();
                                                        echo $row['amount'] == null ? '0' : $row['amount'];
                                                        ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- /.col-md-6 -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.col -->
</div>
<!-- /.row -->

</div>
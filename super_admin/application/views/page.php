<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $page_title; ?> </title>
        <!-- Including Top CSS And JS -->
        <?php require('inc/inc_top.php');?> 
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <!-- Including Top CSS And JS -->
            <?php require('inc/header.php');?> 

            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <?php require('inc/sidebar.php');?>

                <!-- partial -->
                <div class="main-panel">

                    <!-- Main Content -->
                    <?php include 'pages/'.$page_name.'.php';?>
                    <!-- Main Content -->

                    <!-- content-wrapper ends -->
                    <?php require_once('inc/footer.php');?>
                    <!-- partial:partials/_footer.html -->
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- Include Bottom Js -->
        <?php require_once('inc/inc_bottom.php');?>
    </body>
</html>
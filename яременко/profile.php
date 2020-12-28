<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
    <nav class="navbar navbar-dark bg-primary">
    <h1>Profile</h1>
    </nav>
    
    <?php require "process.php"; ?>
        <div class="container-fluid vertical-align">
            <div class="row justify-content-center">
                <div class="col-md-auto">

                    <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="row justify-content-center align-items-center">

                            <div class="col-md-auto picture-size">
                                <div class="card">
                                    <img src="assets/img/<?php if($photo == '') echo 'noimage.png'; else echo $photo; ?>" class="card-img">
                                </div>

                                <?php if($update): ?>
                                    <div class="input-group mb-3" style="top: 10px;">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
    
                            <div class="col-md-auto">

                                <div class="form-group">
                                    <input class="form-control" type="text" name="first_name" value="<?php echo $first_name; ?>">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="last_name" value="<?php echo $last_name; ?>">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" value="<?php echo $role; ?>">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
                                </div>

                                <?php if(isset($_SESSION['role'])): ?>
                                    <?php if(($_SESSION['role'] == 1) || (($_SESSION['role'] == 2) && ($_SESSION['username'] == $first_name))): ?>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" value="<?php echo $password; ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if($update): ?>
                                    <div class="form-group">
                                        <button type="submit" name="update" class="btn btn-info btn-block">Update</button>
                                    </div>
                                <?php else: ?>
                                    <?php if(isset($_SESSION['role'])): ?>
                                        <?php if($_SESSION['role'] == 1 || $_SESSION['username'] == $first_name): ?>
                                            <div class="form-group">
                                                <button type="button" id="edit" class="btn btn-primary btn-block" onClick="location.href='profile.php?id=<?php echo $id; ?>&&edit=<?php echo $id; ?>'">Edit</button>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($_SESSION['role'] == 1): ?>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-danger btn-block" onClick="location.href='profile.php?delete=<?php echo $id; ?>'">Delete</button>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
    
                            </div>
 
                        </div>

                    </form>

                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        
    </body>
</html>
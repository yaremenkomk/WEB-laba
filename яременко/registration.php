<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
    <nav class="navbar navbar-dark bg-primary">
    <h1>Registration</h1>
    </nav>
        <?php require "process.php"; ?>

        <div class="container-fluid vertical-align">
            <div class="row justify-content-center">
                <div class="col-md-auto">

                    <?php if(isset($_SESSION['errorEmail'])): ?>
                        <div class="alert alert-danger" role="alert">User with this email has already signed up!</div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['errorPassword'])): ?>
                        <div class="alert alert-danger" role="alert">Passwords don't match!</div>
                    <?php endif; ?>

                    <form class="form-container needs-validation" method="POST" action="process.php" novalidate>

                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo @$_POST['first_name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" name="role" required>
                                <option selected disabled>Select a role</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="repeatPassword" placeholder="Repeat Password" minlength="6" required>
                        </div>

                        <div>
                            <input type="submit" name="signup" class="btn btn-primary btn-block" value="Sign UP">
                        </div>

                    </form>

                    <script>
                        (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            var forms = document.getElementsByClassName('needs-validation');
                            var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                            });
                        }, false);
                        })();
                    </script>

                </div>
            </div>
        </div>

    </body>
</html>
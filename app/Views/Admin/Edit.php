<?php include_once __DIR__ . '/../Layout/Header.php';

$user = App\Models\User::find($_GET['user']);

if (isset($_GET['edit'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        User Succesfull Updated!

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="container bootstrap snippet my-5">
    <div class="row">
        <div class="col-sm-10">
            <h1><?php echo $user->username ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
            </div>
        </div>

        <div class="col-sm-9">
            <hr>

            <h2>Profile Data</h2>

            <form class="form" action="/admin/edit" method="post">
                <input type="hidden" name="user" value="<?php echo $user->id ?>">
                <div class="form-group">
                    <div class="col-xs-6">
                        <label for="username">
                            <h4>Username</h4>
                        </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user->username ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                        <label for="email">
                            <h4>Email</h4>
                        </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user->email ?>" required>
                    </div>
                </div>

                <input type="submit" class="btnSubmit" value="Save" />
            </form>

            <hr>

            <h2>Block User</h2>

            <?php if ($user->active) { ?>
                <a class="btn btn-danger" href="/admin/block?user=<?php echo $user->id ?>">Block User</a>
            <?php } else { ?>
                <a class="btn btn-danger" href="/admin/unblock?user=<?php echo $user->id ?>">Unblock User</a>
            <?php } ?>
            <hr>

        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../Layout/Footer.php' ?>
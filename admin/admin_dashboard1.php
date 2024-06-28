<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

// Fetch all users
$users_query = "SELECT id, username, role FROM users";
$users_result = $conn->query($users_query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/b4.5.2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
         body{
            background:lightgrey;
         }
        section {
            padding: 20px;
            
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <section>
        <h2 class="text-center"><i class="fas fa-tachometer-alt"></i> Manage Users</h2>
        </section>  <br>
        <section>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><i class="fas fa-id-badge"></i> ID</th>
                    <th><i class="fas fa-user"></i> Username</th>
                    <th><i class="fas fa-user-tag"></i> Role</th>
                    <th><i class="fas fa-tools"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal" data-id="<?php echo $user['id']; ?>" data-username="<?php echo $user['username']; ?>" data-role="<?php echo $user['role']; ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="admin_delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </section>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="admin_edit_user.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel"><i class="fas fa-user-edit"></i> Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Username</label>
                            <input type="text" class="form-control" id="editUsername" disabled>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-key"></i> Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-user-tag"></i> Role</label>
                            <select class="form-control" name="role" id="editRole">
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="farmer">Farmer</option>
                                <option value="buyer">Buyer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var username = button.data('username');
        var role = button.data('role');

        var modal = $(this);
        modal.find('#editUserId').val(id);
        modal.find('#editUsername').val(username);
        modal.find('#editRole').val(role);
    });
    </script>
</body>
</html>
<?php
$conn->close();
?>

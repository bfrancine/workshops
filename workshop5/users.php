<?php
include('utils/functions.php');

// Obtén todos los usuarios de la base de datos
$users = getAllUsers(); 

require('inc/header.php');
?>

<div class="container-fluid">
    <div class="jumbotron">
        <h1 class="display-4">Users</h1>
        <p class="lead">List of users</p>
        <hr class="my-4">
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th> <!-- Columna para acciones como editar o eliminar -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($user['lastName']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                        
                         <a href="Update.php?email=<?php echo urlencode($user['email']); ?>" class="btn btn-warning">Edit</a>
                            <form action="actions/delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require('inc/footer.php'); ?>
<?php
include('utils/functions.php');
$provinces= getProvinces();
$roles= getRole();
$error_msg = '';
// Obtén el email del usuario a editar
$email = $_GET['email'] ?? null;

if ($email) {
    // Aquí deberías buscar el usuario por su email y cargar sus datos
    $user = getUserByEmail($email); // Asegúrate de tener esta función en utils/functions.php
}

require('inc/header.php');
?>


<div class="container-fluid">
    <div class="jumbotron">
        <h1 class="display-4">update user</h1>
        <p class="lead">User update process</p>
        <hr class="my-4">
    </div>
    <form method="post" action="actions/update.php">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="error">
            <?php echo htmlspecialchars($error_msg); ?>
        </div>
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input id="first-name" class="form-control" type="text" name="firstName" value="<?php echo htmlspecialchars($user['firstName'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input id="last-name" class="form-control" type="text" name="lastName" value="<?php echo htmlspecialchars($user['lastName'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="province_id">Province</label>
            <select id="province" class="form-control" name="province_id" required>
                <?php
                foreach($provinces as $province) {
                    echo "<option value=\"" . htmlspecialchars($province['province_name']) . "\" " . (isset($user['province_id']) && $user['province_id'] == $province['province_name'] ? 'selected' : '') . ">" . htmlspecialchars($province['province_name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="password">New Password (leave empty so it doesn't change)</label>
            <input id="password" class="form-control" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select id="role" class="form-control" name="role" required>
                <?php
                foreach($roles as $role) {
                    echo "<option value=\"" . htmlspecialchars($role['role']) . "\" " . (isset($user['role']) && $user['role'] == $role['role'] ? 'selected' : '') . ">" . htmlspecialchars($role['role']) . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">UpDate</button>
    </form>
</div>

<?php require('inc/footer.php'); ?>
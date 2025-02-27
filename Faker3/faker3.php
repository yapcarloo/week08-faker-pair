<?php
require 'vendor/autoload.php';

$faker = Faker\Factory::create();

// Function to generate a UUID
function generateUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

// Generate 10 fake user accounts
$users = [];
for ($i = 0; $i < 10; $i++) {
    $fullName = $faker->name;
    $email = $faker->email;
    $username = strtolower(explode('@', $email)[0]); // Extracts first part before @
    $password = hash('sha256', $faker->password); // SHA-256 hashed password
    $accountCreated = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s');

    $users[] = [
        'user_id'        => generateUUID(),
        'full_name'      => $fullName,
        'email'          => $email,
        'username'       => $username,
        'password'       => $password,
        'account_created' => $accountCreated
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake User Accounts</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .uuid { font-size: 0.85rem; word-break: break-word; }
        .password { font-size: 0.85rem; word-break: break-word; }
    </style>
</head>
<body class="container mt-5">

    <h2 class="mb-4 text-center">Fake User Accounts</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password (SHA-256)</th>
                <th>Account Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td class="uuid"><?= htmlspecialchars($user['user_id']) ?></td>
                    <td><?= htmlspecialchars($user['full_name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td class="password"><?= htmlspecialchars($user['password']) ?></td>
                    <td><?= htmlspecialchars($user['account_created']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
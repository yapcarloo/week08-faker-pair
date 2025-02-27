<?php
require 'vendor/autoload.php';

$faker = Faker\Factory::create();

$genres = [
    "Fiction", "Mystery", "Science Fiction", "Fantasy", 
    "Romance", "Thriller", "Historical", "Horror"
];

// Generate 15 fake book records
$books = [];
for ($i = 0; $i < 15; $i++) {
    $books[] = [
        'title'             => $faker->sentence(3), // Generates a 3-word title
        'author'            => $faker->name, // Random full name
        'genre'             => $faker->randomElement($genres), // Random genre
        'publication_year'  => $faker->numberBetween(1900, 2024), // Year between 1900-2024
        'isbn'              => $faker->isbn13, // Random 13-digit ISBN
        'summary'           => $faker->paragraph(2) // Generates a short summary
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Books Table</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4 text-center">Fake Book Records</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Publication Year</th>
                <th>ISBN</th>
                <th>Summary</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= htmlspecialchars($book['publication_year']) ?></td>
                    <td><?= htmlspecialchars($book['isbn']) ?></td>
                    <td><?= htmlspecialchars($book['summary']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

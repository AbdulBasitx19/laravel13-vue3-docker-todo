<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Vue 3 Docker App</title>

    <!-- Bootstrap 5 CSS for Clean UI Styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Vite directive jo JS aur Vue Components ko bundle karke load karta hai -->
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

    <!-- Vue 3 App Mount Point -->
    <div id="app"></div>

</body>
</html>
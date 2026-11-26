<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Alzikrayat - Photo Sharing</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="/alzikrayat/public/css/style.css">

</head><body><nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">    <!-- Application Logo -->
    <a class="navbar-brand fw-bold" href="/alzikrayat/public/">
        Alzikrayat
    </a>

    <!-- Mobile Menu Button -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

    </button>

    <!-- Navigation Links -->
    <div class="collapse navbar-collapse" id="navbarMenu">

        <div class="navbar-nav ms-auto">

            <a class="nav-link" href="/alzikrayat/public/">
                Home
            </a>

            <a class="nav-link" href="/alzikrayat/public/gallery">
                Gallery
            </a>

            <a class="nav-link" href="/alzikrayat/public/about">
                About Us
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>

                <span class="nav-link text-info">
                    Hi <?= htmlspecialchars($_SESSION['first_name']) ?>
                </span>

                <a class="nav-link" href="/alzikrayat/public/upload">
                    Upload Photo
                </a>

                <a class="nav-link" href="/alzikrayat/public/logout">
                    Logout
                </a>

            <?php else: ?>

                <a class="nav-link" href="/alzikrayat/public/login">
                    Please Login
                </a>

                <a class="nav-link" href="/alzikrayat/public/register">
                    Register
                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

</nav><main class="container mt-4">
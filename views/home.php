<div class="text-center p-5 bg-white rounded shadow-sm">

    <h1 class="display-4 fw-bold">
        Welcome to Alzikrayat
    </h1>

    <p class="lead mt-3">
        Share your beautiful memories and keep your moments alive.
    </p>

    <a href="/alzikrayat/public/gallery"
       class="btn btn-primary btn-lg mt-3">
        Explore Gallery
    </a>

    <a href="/alzikrayat/public/upload"
       class="btn btn-success btn-lg mt-3">
        Share a Memory
    </a>

</div>

<!-- Statistics -->

<h2 class="text-center mt-5 mb-4">Our Community</h2>

<div class="row text-center g-4">

    <div class="col-md-4">
        <div class="card shadow p-4">
            <h2><?= (int)$usersCount ?></h2>
            <p class="mb-0">Registered Users</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-4">
            <h2><?= (int)$photosCount ?></h2>
            <p class="mb-0">Shared Photos</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-4">
            <h2><?= (int)$commentsCount ?></h2>
            <p class="mb-0">Comments</p>
        </div>
    </div>

</div>

<!-- Latest Photos -->

<h2 class="mt-5 mb-4">Latest Memories</h2>

<div class="row g-4">

    <?php if (!empty($photos)): ?>

        <?php foreach (array_slice($photos, 0, 3) as $photo): ?>

            <div class="col-md-4">

                <div class="card shadow-sm">

                    <img
                        src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;"
                        alt="<?= htmlspecialchars($photo['title']) ?>"
                    >

                    <div class="card-body">

                        <h5>
                            <?= htmlspecialchars($photo['title']) ?>
                        </h5>

                        <a href="/alzikrayat/public/photo/<?= (int)$photo['id'] ?>"
                           class="btn btn-primary">
                            View Photo
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p class="text-center text-muted">
            No memories shared yet. Be the first to upload a photo!
        </p>

    <?php endif; ?>

</div>
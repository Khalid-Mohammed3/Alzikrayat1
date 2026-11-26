<h2 class="mb-4">Photo Gallery</h2>

<div class="d-flex justify-content-between align-items-center mb-4">

    <p class="text-muted mb-0">Explore shared memories</p>

    <div>
        <button class="btn btn-outline-primary" onclick="changeLayout(3)">
            3 Columns
        </button>

        <button class="btn btn-outline-primary" onclick="changeLayout(4)">
            4 Columns
        </button>

        <button class="btn btn-outline-primary" onclick="changeLayout('list')">
            List View
        </button>
    </div>

</div>

<div class="row g-4" id="gallery">

    <?php if (!empty($photos)): ?>

        <?php foreach ($photos as $photo): ?>

            <div class="gallery-item col-md-4">

                <div class="card shadow-sm h-100">

                    <img
                        src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;"
                        alt="<?= htmlspecialchars($photo['title']) ?>"
                    >

                    <div class="card-body">

                        <h5 class="card-title">
                            <?= htmlspecialchars($photo['title']) ?>
                        </h5>

                        <p class="text-muted">
                            By:
                            <?= htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']) ?>
                        </p>

                        <a href="/alzikrayat/public/photo/<?= (int)$photo['id'] ?>"
                           class="btn btn-primary">
                            View Details
                        </a>

                        <?php if (
                            isset($_SESSION['user_id']) &&
                            $_SESSION['user_id'] == $photo['user_id']
                        ): ?>

                            <form method="POST"
                                  action="/alzikrayat/public/photo/<?= (int)$photo['id'] ?>/delete"
                                  class="d-inline">

                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Delete this photo?')">
                                    Delete
                                </button>

                            </form>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p class="text-center text-muted">
            No photos available yet.
        </p>

    <?php endif; ?>

</div>
<script src="/alzikrayat/public/js/gallery.js"></script>
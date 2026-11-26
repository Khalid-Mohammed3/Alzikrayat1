<div class="row justify-content-center">
    <div class="col-lg-9">    <div class="card shadow p-4">

        <h1 class="mb-3">
            <?= htmlspecialchars($photo['title']) ?>
        </h1>

        <img
            src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
            alt="Photo"
            class="img-fluid rounded mb-3"
        >

        <p>
            <?= nl2br(htmlspecialchars($photo['description'] ?? '')) ?>
        </p>

        <hr>

        <h2>Comments</h2>

        <?php if (empty($comments)): ?>

            <p class="text-muted">No comments yet.</p>

        <?php else: ?>

            <?php foreach ($comments as $comment): ?>

                <div class="border rounded p-3 mb-3">

                    <strong>
                        <?= htmlspecialchars(
                            $comment['first_name'] . ' ' . $comment['last_name']
                        ) ?>
                    </strong>

                    <p class="mt-2 mb-1">
                        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                    </p>

                    <small class="text-muted">
                        <?= htmlspecialchars($comment['date_time']) ?>
                    </small>

                    <?php if (
                        isset($_SESSION['user_id']) &&
                        $_SESSION['user_id'] == $comment['user_id']
                    ): ?>

                        <form
                            action="/alzikrayat/public/comment/<?= (int)$comment['id'] ?>/delete"
                            method="POST"
                            class="mt-2"
                        >
                            <button type="submit" class="btn btn-danger btn-sm">
                                Delete Comment
                            </button>
                        </form>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>

            <hr>

            <h3>Add a Comment</h3>

            <form
                id="commentForm"
                action="/alzikrayat/public/photo/<?= (int)$photo['id'] ?>/comment"
                method="POST"
            >

                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    maxlength="1000"
                    required
                    placeholder="Write your comment..."
                    rows="4"
                ></textarea>

                <button type="submit" class="btn btn-primary mt-3">
                    Post Comment
                </button>

            </form>

        <?php else: ?>

            <p>
                <a href="/alzikrayat/public/login">
                    Login to comment
                </a>
            </p>

        <?php endif; ?>

        <a href="/alzikrayat/public/gallery" class="btn btn-outline-secondary mt-4">
            Back to Gallery
        </a>

    </div>

</div>

</div><script src="/alzikrayat/public/js/validation.js"></script>
<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4">Upload Your Memory</h2>

            <form id="uploadForm"
                  action="/alzikrayat/public/upload/store"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Photo Title:</label>

                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control"
                           maxlength="200"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>

                    <textarea id="description"
                              name="description"
                              class="form-control"
                              maxlength="1000"
                              rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Photo:</label>

                    <input type="file"
                           id="photo"
                           name="photo"
                           class="form-control"
                           accept="image/jpeg,image/png,image/gif,image/webp"
                           required>
                    <small class="text-muted">
                        Allowed formats: JPG, PNG, GIF, WEBP. Maximum size: 5MB.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Upload Photo
                </button>

            </form>

            <a href="/alzikrayat/public/gallery"
               class="btn btn-outline-secondary mt-3">
                Back to Gallery
            </a>

        </div>

    </div>
</div>

<script src="/alzikrayat/public/js/validation.js"></script>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">    <div class="card shadow p-4">

        <h2 class="text-center mb-4">Create Account</h2>

        <form id="registerForm"
              action="/alzikrayat/public/register/store"
              method="POST">

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text"
                       id="first_name"
                       name="first_name"
                       class="form-control"
                       minlength="2"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text"
                       id="last_name"
                       name="last_name"
                       class="form-control"
                       minlength="2"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       minlength="8"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Register
            </button>

        </form>

    </div>

</div>

</div><script src="/alzikrayat/public/js/validation.js"></script>
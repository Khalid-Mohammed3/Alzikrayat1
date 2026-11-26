<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4">Welcome Back</h2>

            <form action="/alzikrayat/public/login/authenticate" method="POST">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Login
                </button>

            </form>

            <p class="text-center mt-3">
                Don't have an account?
                <a href="/alzikrayat/public/register">Register</a>
            </p>

        </div>

    </div>
</div>
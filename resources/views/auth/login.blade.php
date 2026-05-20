<x-guest-layout>
    <div class="container-fluid min-vh-100">
        <div class="row min-vh-100">
            <div class="col-lg-7 d-none d-lg-flex flex-column justify-content-center px-5 text-white" style="background: linear-gradient(135deg, #2563eb, #1e3a8a, #0f172a);">
                <div style="max-width:650px;">
                    <div class="d-flex align-items-center gap-4 mb-5">
                        <div style="width:88px; height:88px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius:24px; display:flex; align-items:center; justify-content:center; font-size:38px; font-weight:900; letter-spacing:-3px; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.35);">
                            <span style="color:white;">M</span><span style="color:#bfdbfe;">R</span>
                        </div>
                        <div>
                            <h1 style="font-size:54px; font-weight:800; line-height:1; margin:0; letter-spacing:-2px;">MultiRental</h1>
                            <div style="font-size:22px; opacity:.78; font-weight:500; margin-top:4px;">Marketplace platform</div>
                        </div>
                    </div>

                    <h1 class="display-3 fw-bold mb-4" style="line-height:1.05;">Rent anything.</h1>
                    <p class="fs-4 opacity-75">The next generation rental marketplace.<br>List products. Rent equipment. Build trust.</p>
                </div>
            </div>

            <div class="col-lg-5 d-flex align-items-center justify-content-center p-4" style="background:#eef2f7;">
                <div class="card border-0 shadow-lg rounded-5 p-5 w-100" style="max-width:520px;">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Welcome back</h2>
                        <p class="text-secondary">Login to MultiRental</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-2">Email</label>
                            <input name="email" type="email" class="form-control form-control-lg rounded-4" required>
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Password</label>
                            <input name="password" type="password" class="form-control form-control-lg rounded-4" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div><input type="checkbox" name="remember"> Remember me</div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                        </div>

                        <button class="btn btn-primary btn-lg w-100 rounded-4 py-3 fw-bold shadow-sm">Login</button>

                        <div class="text-center mt-4">
                            No account? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Create one</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
<x-app-layout>
    <div class="container py-5">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden mb-5">
            <div style="height:260px; position:relative; overflow:hidden;">
                @if(Auth::user()->banner)
                    <img src="{{ asset('storage/' . Auth::user()->banner) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="height:100%; background: linear-gradient(135deg, #2563eb, #1e40af, #0f172a);">
                        <div style="position:absolute; right:50px; top:20px; font-size:120px; font-weight:900; opacity:.08; color:white;">MR</div>
                    </div>
                @endif
            </div>

            <div class="card-body px-5 pb-5">
                <div class="row align-items-end gx-5">
                    <div class="col-lg-auto">
                        <div class="shadow-lg border border-5 border-white overflow-hidden rounded-circle bg-white" style="width:170px; height:170px; margin-top:-90px;">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center fw-bold text-white" style="width:100%; height:100%; font-size:60px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <h1 class="fw-bold mb-2 d-flex align-items-center gap-2 flex-wrap">
                            {{ Auth::user()->name }}
                            @if(Auth::user()->is_admin)
                                <span class="badge bg-danger px-3 py-2 rounded-pill" style="font-size:12px; letter-spacing:1px;">ADMIN</span>
                            @endif
                        </h1>
                        <div class="d-flex gap-2 flex-wrap mb-3">
                            <span class="badge bg-primary px-3 py-2">Verified Marketplace User</span>
                            <span class="badge bg-dark px-3 py-2">Member since {{ Auth::user()->created_at->format('Y') }}</span>
                        </div>
                        <p class="text-secondary mb-1">📍 {{ Auth::user()->city ?? 'Location not set' }}</p>
                        <p class="text-secondary">{{ Auth::user()->bio ?? 'No bio yet.' }}</p>
                    </div>

                    <div class="col-lg-auto">
                        <a href="/settings" class="btn btn-primary btn-lg px-4 rounded-4">⚙ Settings</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $rating = round(Auth::user()->reviewsReceived()->avg('rating') ?? 0, 1);
            $reviews = Auth::user()->reviewsReceived()->count();
        @endphp

        <div class="row g-4 justify-content-center mb-4">
            <div class="col-md-4">
                <a href="/inventory/{{ Auth::id() }}" class="text-decoration-none d-block h-100">
                    <div class="card shadow-sm border-0 rounded-5 text-center hover-card h-100">
                        <div class="card-body py-4">
                            <h1 class="fw-bold text-primary">{{ Auth::user()->items()->count() }}</h1>
                            <div class="text-secondary">Items</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-5 text-center h-100">
                    <div class="card-body py-4">
                        <h1 class="fw-bold text-success">{{ Auth::user()->rentals()->count() }}</h1>
                        <div class="text-secondary">Rentals</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <a href="/users/{{ Auth::id() }}/reviews" class="text-decoration-none d-block h-100">
                    <div class="card shadow-sm border-0 rounded-5 text-center hover-card h-100">
                        <div class="card-body py-4">
                            <h1 class="fw-bold text-warning">⭐ {{ $rating }}</h1>
                            <div class="text-secondary">Average Rating</div>
                            <div class="small text-secondary mt-2">{{ $reviews }} reviews</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-2 g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-5 h-100">
                    <div class="card-body p-4">
                        <h4>About User</h4>
                        <hr>
                        <p class="mb-0">{{ Auth::user()->bio ?? 'No information provided.' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-5 h-100">
                    <div class="card-body p-4">
                        <h4>Marketplace Stats</h4>
                        <hr>
                        <div class="mb-3">📦 {{ Auth::user()->items()->count() }} active listings</div>
                        <div class="mb-3">🤝 {{ Auth::user()->rentals()->where('status', 'returned')->count() }} completed rentals</div>
                        <div>⭐ {{ $reviews }} community reviews</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-card {
            transition: .18s;
            cursor: pointer;
        }
        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15) !important;
        }
    </style>
</x-app-layout>
<x-app-layout>
    @php
        $owner = $item->owner;
        $ownerRating = round($owner->reviewsReceived()->avg('rating') ?? 0, 1);
        $ownerReviews = $owner->reviewsReceived()->count();
        $completedRentals = $owner->rentals()->where('status', 'returned')->count();
        $image = $item->image ? (Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('storage/' . $item->image)) : 'https://picsum.photos/1000/700?random=' . $item->id;
    @endphp

    <div class="container py-5" style="background: linear-gradient(180deg, #eef2f7, #f8fafc);">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden mb-4">
                    <div style="height:500px; background:#edf2f7; overflow:hidden;">
                        <img src="{{ $image }}" loading="lazy" onerror="this.onerror=null; this.src='https://picsum.photos/1000/700?random={{ $item->id+999 }}';" style="width:100%; height:100%; object-fit:cover; transition:.35s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-5 p-4">
                    <div class="row g-3 text-center">
                        <div class="col-4">
                            <div class="bg-light rounded-4 p-3 h-100">
                                <div class="fs-3">📦</div>
                                <div class="small text-secondary">Category</div>
                                <div class="fw-bold">{{ $item->category->name }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-light rounded-4 p-3 h-100">
                                <div class="fs-3">📅</div>
                                <div class="small text-secondary">Listed</div>
                                <div class="fw-bold">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-light rounded-4 p-3 h-100">
                                <div class="fs-3">📍</div>
                                <div class="small text-secondary">Location</div>
                                <div class="fw-bold">{{ $item->location }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-5 p-4" style="position:sticky; top:100px;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="fw-bold mb-0">{{ $item->title }}</h1>
                        <span class="badge px-3 py-2 rounded-pill {{ $item->status == 'available' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($item->status) }}</span>
                    </div>

                    <div class="display-4 fw-bold mb-3 text-primary">
                        {{ number_format($item->price_per_day, 0) }} zł <span class="fs-5 fw-normal text-secondary">/ day</span>
                    </div>

                    <div class="d-flex gap-4 text-secondary mb-4">
                        <div>📍 {{ $item->location }}</div>
                        <div>📦 {{ $item->category->name }}</div>
                    </div>
                    <hr>

                    <a href="{{ route('profile.show', $owner) }}" class="text-decoration-none text-dark">
                        <div class="bg-light rounded-5 p-4 mb-4 owner-box">
                            <div class="d-flex align-items-center gap-3">
                                @if($owner->avatar)
                                    <img src="{{ asset('storage/' . $owner->avatar) }}" style="width:72px; height:72px; border-radius:50%; object-fit:cover;">
                                @else
                                    <div style="width:72px; height:72px; border-radius:50%; background: linear-gradient(135deg, #2563eb, #60a5fa); display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:700; color:white;">
                                        {{ strtoupper(substr($owner->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold fs-5">{{ $owner->name }}</div>
                                    <div class="text-secondary">⭐ {{ $ownerRating }} · {{ $ownerReviews }} reviews</div>
                                    <div class="small text-secondary">🤝 {{ $completedRentals }} completed rentals</div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @if(Auth::check() && Auth::id() !== $item->owner_id)
                        <a href="{{ route('rentals.create', $item) }}" class="btn btn-primary w-100 rounded-4 fw-semibold mb-3" style="height:56px; display:flex; align-items:center; justify-content:center;">Rent Now</a>
                        <a href="/messages/start/{{ $owner->id }}" class="btn btn-outline-dark w-100 rounded-4 d-flex align-items-center justify-content-center" style="height:56px;">✉ Message Owner</a>
                    @endif

                    @if(Auth::check() && Auth::id() === $item->owner_id)
                        <a href="{{ route('items.edit', $item) }}" class="btn btn-warning w-100 rounded-4 fw-semibold" style="height:56px; display:flex; align-items:center; justify-content:center;">Edit Listing</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-5">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4">Description</h3>
                        <p style="line-height:2; font-size:17px;">{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .owner-box { transition: .2s; }
        .owner-box:hover { transform: translateY(-3px); background: #edf4ff !important; }
    </style>
</x-app-layout>
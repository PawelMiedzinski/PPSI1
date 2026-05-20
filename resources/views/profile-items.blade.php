<x-app-layout>
    <div class="container py-5">
        <div class="mb-4">
            <a href="/dashboard" class="text-decoration-none fw-semibold">← Back</a>
        </div>

        <div class="mb-5">
            <h1 class="fw-bold mb-2">{{ $user->name }}'s Items</h1>
            <p class="text-secondary">Browse all listings created by this user.</p>
        </div>

        @if($items->count())
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('items.show', $item) }}" class="text-decoration-none text-dark">
                            <div class="card border-0 shadow-sm rounded-5 overflow-hidden hover-card h-100">
                                <div style="height:230px; background:#edf2f7;">
                                    @if($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <div class="h-100 d-flex justify-content-center align-items-center text-secondary fs-3">📦</div>
                                    @endif
                                </div>
                                
                                <div class="card-body p-4">
                                    <div class="small text-secondary mb-2">{{ $item->category->name }}</div>
                                    <h5 class="fw-bold mb-3">{{ $item->title }}</h5>
                                    <div class="fw-bold text-primary fs-4">
                                        {{ number_format($item->price_per_day, 0) }} zł <span class="text-secondary fs-6 fw-normal">/ day</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card border-0 shadow-sm rounded-5 text-center p-5">
                <div style="font-size:70px;">📦</div>
                <h4>No listings yet</h4>
                <p class="text-secondary">This user has not added items.</p>
            </div>
        @endif
    </div>

    <style>
        .hover-card {
            transition: .18s;
        }
        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15) !important;
        }
    </style>
</x-app-layout>
<x-app-layout>
    <div class="container py-5" style="max-width:900px;">
        <div class="mb-4">
            <a href="{{ route('items.show', $item) }}" class="text-decoration-none fw-semibold">← Back to listing</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger rounded-4 shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="card border-0 shadow-lg rounded-5 overflow-hidden mb-4">
            <div class="row g-0">
                <div class="col-md-5">
                    <div style="height:100%; min-height:260px; background: linear-gradient(135deg, #edf2f7, #f8fafc);">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <div style="font-size:70px; opacity:.3;">📦</div>
                                <div class="fw-bold">No image</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="p-5">
                        <div class="small text-secondary mb-2">{{ $item->category->name }}</div>
                        <h1 class="fw-bold mb-3">{{ $item->title }}</h1>
                        <div class="display-5 fw-bold mb-4" style="background: linear-gradient(135deg, #2563eb, #60a5fa); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                            {{ number_format($item->price_per_day, 0) }} zł <span class="fs-5 fw-normal text-secondary">/ day</span>
                        </div>
                        <div class="text-secondary">📍 {{ $item->location }}</div>
                        <div class="mt-3 small text-success fw-semibold">✓ Verified listing</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg rounded-5">
            <div class="card-body p-5">
                <h3 class="fw-bold mb-4">Rental Period</h3>
                <form method="POST" action="{{ route('rentals.store') }}">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="fw-semibold mb-2">Start date</label>
                            <input type="date" name="start_date" id="startDate" required value="{{ old('start_date') }}" min="{{ now()->format('Y-m-d') }}" class="form-control form-control-lg rounded-4">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="fw-semibold mb-2">End date</label>
                            <input type="date" name="end_date" id="endDate" required value="{{ old('end_date') }}" min="{{ now()->format('Y-m-d') }}" class="form-control form-control-lg rounded-4">
                        </div>
                    </div>

                    <div class="bg-light rounded-5 p-4 mb-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Rental duration</span>
                            <strong id="daysPreview">0 days</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Daily rate</span>
                            <strong>{{ number_format($item->price_per_day, 0) }} zł</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-4 fw-bold">
                            <span>Total</span>
                            <span id="pricePreview" class="text-primary">0 zł</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-4 w-100 py-3 fw-bold">Confirm Rental</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const start = document.getElementById('startDate');
        const end = document.getElementById('endDate');
        const days = document.getElementById('daysPreview');
        const price = document.getElementById('pricePreview');
        const daily = {{ $item->price_per_day }};

        function calculate() {
            if (!start.value || !end.value) {
                days.innerHTML = '0 days';
                price.innerHTML = '0 zł';
                return;
            }
            const s = new Date(start.value);
            const e = new Date(end.value);
            const diff = Math.ceil((e - s) / 86400000) + 1;

            if (diff <= 0) {
                days.innerHTML = 'Invalid';
                price.innerHTML = '0 zł';
                return;
            }
            days.innerHTML = `${diff} day${diff > 1 ? 's' : ''}`;
            price.innerHTML = `${(daily * diff).toFixed(2)} zł`;
        }

        start.addEventListener('change', calculate);
        end.addEventListener('change', calculate);
        calculate();
    </script>
</x-app-layout>
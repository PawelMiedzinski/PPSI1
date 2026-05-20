<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                    <div class="p-5 text-white" style="background: linear-gradient(135deg, #2563eb, #1d4ed8, #0f172a);">
                        <h1 class="fw-bold">Create Listing</h1>
                        <p class="opacity-75 mb-0">Add a new item to MultiRental marketplace.</p>
                    </div>
                    
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger rounded-4 mb-4">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Title</label>
                                <input name="title" value="{{ old('title') }}" class="form-control form-control-lg rounded-4" placeholder="Mountain bike" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" rows="5" class="form-control rounded-4" placeholder="Describe your item..." required>{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="fw-semibold">Price / day (PLN)</label>
                                    <div class="input-group">
                                        <input name="price_per_day" type="number" step="0.01" min="0" value="{{ old('price_per_day') }}" class="form-control rounded-start-4" required>
                                        <span class="input-group-text rounded-end-4">zł</span>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="fw-semibold">Location</label>
                                    <input name="location" value="{{ old('location') }}" class="form-control rounded-4" placeholder="Warsaw" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="fw-semibold">Category</label>
                                <select name="category_id" class="form-select rounded-4" required>
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold">Item image</label>
                                <input type="file" name="image" id="image" class="form-control rounded-4" accept="image/*">
                                <div class="small text-secondary mt-2">PNG JPG WEBP • max 8MB</div>
                                <div id="selectedFile" class="small text-primary mt-2 fw-semibold"></div>
                            </div>

                            <div class="d-flex gap-3">
                                <button class="btn btn-primary btn-lg rounded-4 px-5">Publish listing</button>
                                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary btn-lg rounded-4">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            document.getElementById('selectedFile').innerText = file ? "Selected: " + file.name : "";
        });
    </script>
</x-app-layout>
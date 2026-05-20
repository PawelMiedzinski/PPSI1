<x-app-layout>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-xl-10">

<div
class="
card
border-0
shadow-lg
rounded-5
overflow-hidden
"
>

<div
class="p-5 text-white"
style="
background:
linear-gradient(
135deg,
#2563eb,
#1d4ed8,
#0f172a
);
"
>

<h1 class="fw-bold mb-2">

Edit Listing

</h1>

<p class="opacity-75 mb-0">

Update your marketplace item.

</p>

</div>

<div class="card-body p-5">

<form

method="POST"

action="{{ route('items.update',$item) }}"

enctype="multipart/form-data"

>

@csrf
@method('PUT')

<div class="row g-5">

<div class="col-lg-8">

<div class="mb-4">

<label
class="
fw-semibold
mb-2
"
>

📝 Title

</label>

<input

name="title"

class="
form-control
form-control-lg
rounded-4
"

value="{{ old('title',$item->title) }}"

required

>

</div>



<div class="mb-4">

<label
class="
fw-semibold
mb-2
"
>

📄 Description

</label>

<textarea

name="description"

rows="6"

class="
form-control
rounded-4
"

required

>{{ old('description',$item->description) }}</textarea>

</div>



<div class="row">

<div class="col-md-6 mb-4">

<label
class="
fw-semibold
mb-2
"
>

💰 Price / day

</label>

<input

name="price_per_day"

type="number"

step="0.01"

min="0"

class="
form-control
rounded-4
"

value="{{ old('price_per_day',$item->price_per_day) }}"

required

>

</div>


<div class="col-md-6 mb-4">

<label
class="
fw-semibold
mb-2
"
>

📍 Location

</label>

<input

name="location"

class="
form-control
rounded-4
"

value="{{ old('location',$item->location) }}"

required

>

</div>

</div>



<div class="mb-4">

<label
class="
fw-semibold
mb-2
"
>

📦 Category

</label>

<select

name="category_id"

class="
form-select
rounded-4
"

required

>

@foreach($categories as $category)

<option

value="{{ $category->id }}"

{{

$item->category_id
==
$category->id

?

'selected'

:

''

}}

>

{{ $category->name }}

</option>

@endforeach

</select>

</div>



<div class="mb-4">

<label
class="
fw-semibold
mb-2
"
>

🏷 Status

</label>

<select

name="status"

class="
form-select
rounded-4
"

>

<option

value="available"

{{

$item->status
==
'available'

?

'selected'

:

''

}}

>

Available

</option>

<option

value="rented"

{{

$item->status
==
'rented'

?

'selected'

:

''

}}

>

Rented

</option>

</select>

</div>

</div>



<div class="col-lg-4">

<div
class="
card
border-0
bg-light
rounded-5
shadow-sm
h-100
"
>

<div class="card-body">

<h5
class="
fw-bold
mb-4
"
>

🖼 Listing Preview

</h5>

<img

id="preview"

src="{{ asset('storage/'.$item->image) }}"

class="
w-100
rounded-4
shadow-sm
mb-4
"

style="
height:260px;
object-fit:cover;
"

>

<div class="mb-3">

<label
class="
fw-semibold
mb-2
"
>

Replace image

</label>

<input

id="imageInput"

type="file"

name="image"

accept="image/*"

class="
form-control
rounded-4
"

>

</div>

<div
class="
small
text-secondary
"
>

PNG JPG WEBP

<br>

Maximum 8MB

</div>

<hr>

<div class="small">

<div>

Created:

<strong>

{{

$item->created_at

->format('d.m.Y')

}}

</strong>

</div>

<div class="mt-2">

Current status:

<strong>

{{

strtoupper(

$item->status

)

}}

</strong>

</div>

</div>

</div>

</div>

</div>

</div>



<div
class="
d-flex
gap-3
mt-5
"
>

<button

class="
btn
btn-primary
btn-lg
rounded-4
px-5
shadow-sm
"

>

Save Changes

</button>

<a

href="{{ route('items.show',$item) }}"

class="
btn
btn-outline-secondary
btn-lg
rounded-4
"

>

Cancel

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>



<script>

document

.getElementById(

'imageInput'

)

.addEventListener(

'change',

function(e){

const file=

e.target.files[0];

if(!file)return;

document

.getElementById(

'preview'

)

.src=

URL.createObjectURL(

file

);

}

);

</script>

</x-app-layout>
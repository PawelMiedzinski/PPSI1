<x-app-layout>

<div class="container py-5">

<div
class="
card
border-0
shadow-sm
rounded-5
p-4
mb-5
"
>

<form>

<div class="row g-3">

<div class="col-lg-6">

<input

name="search"

value="{{ request('search') }}"

class="form-control"

placeholder="Search items..."

>

</div>

<div class="col-lg-3">

<input

name="city"

value="{{ request('city') }}"

class="form-control"

placeholder="City"

>

</div>

<div class="col-lg-3">

<button
class="
btn
btn-primary
w-100
"
>

Search

</button>

</div>

</div>

</form>

</div>


<div class="row g-4">

@forelse($items as $item)

<div class="col-md-6 col-xl-4">

<div
class="
card
border-0
shadow-sm
rounded-5
overflow-hidden
h-100
market-card
"
>

<div
style="
height:220px;
background:#e2e8f0;
"
>

@if($item->image)

<img

src="{{ asset('storage/' . $item->image) }}"

style="
width:100%;
height:100%;

object-fit:cover;
"

>

@else

<div

class="
d-flex
justify-content-center
align-items-center
h-100
text-secondary
"

>

📦 No image

</div>

@endif

</div>

<div class="card-body">

<h4
class="
fw-bold
mb-2
"
>

{{ $item->name }}

</h4>

<p
class="
text-secondary
small
"
>

{{ Str::limit(

$item->description,

70

) }}

</p>

<div
class="
d-flex
justify-content-between
align-items-center
mt-3
"
>

<div>

<div
class="
fw-bold
text-primary
fs-4
"
>

{{ $item->price }}

zł

</div>

<div
class="
text-secondary
small
"
>

per day

</div>

</div>

<div
class="
text-secondary
small
text-end
"
>

📍

{{

$item->user->city

??

'Unknown'

}}

<br>

👤

{{

$item->user->name

}}

</div>

</div>

<a

href="/items/{{ $item->id }}"

class="
btn
btn-primary
w-100
mt-4
"

>

View Item

</a>

</div>

</div>

</div>

@empty

<div
class="
text-center
py-5
"
>

<h3>

No items found

</h3>

<p class="text-secondary">

Try another search.

</p>

</div>

@endforelse

</div>


<div
class="
mt-5
d-flex
justify-content-center
"
>

{{ $items->links() }}

</div>

</div>

</x-app-layout>
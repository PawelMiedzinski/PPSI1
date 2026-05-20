<x-app-layout>

<div class="container py-5">

<div
class="
card
border-0
shadow-lg
rounded-5
overflow-hidden
mb-5
"
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

<div class="card-body p-5 text-white">

<div class="row align-items-center">

<div class="col-lg-8">

<span
class="
badge
bg-light
text-primary
mb-3
px-3
py-2
"
>

MULTIRENTAL MARKETPLACE

</span>

<h1
class="
display-4
fw-bold
mb-3
"
>

Browse rentals.

Find anything.

</h1>

<p
class="
fs-5
opacity-75
mb-0
"
>

Equipment.

Electronics.

Tools.

Vehicles.

Everything in one place.

</p>

</div>

<div
class="
col-lg-4
text-end
d-none
d-lg-block
"
>

<div
style="
font-size:120px;
font-weight:900;
opacity:.08;
"
>

MR

</div>

</div>

</div>

</div>

</div>



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

<div class="col-lg-5">

<input

name="search"

value="{{ request('search') }}"

placeholder="Search items..."

class="
form-control
form-control-lg
rounded-4
"

>

</div>


<div class="col-lg-3">

<input

name="location"

value="{{ request('location') }}"

placeholder="Location"

class="
form-control
form-control-lg
rounded-4
"

>

</div>


<div class="col-lg-2">

<select

name="status"

class="
form-select
form-select-lg
rounded-4
"

>

<option value="">

All statuses

</option>

<option
value="available"

{{

request('status')=='available'

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

request('status')=='rented'

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


<div class="col-lg-2">

<button
class="
btn
btn-primary
btn-lg
rounded-4
w-100
"
>

Search

</button>

</div>

</div>

</form>

</div>



<div
class="
d-flex
justify-content-between
align-items-center
mb-4
"
>

<h2
class="
fw-bold
mb-0
"
>

Marketplace

</h2>

<div class="text-secondary">

{{ $items->total() }}

items

</div>

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
height:240px;
background:#e2e8f0;
position:relative;
"
>

@if($item->image)

<img

src="{{ asset(

'storage/'.

$item->image

) }}"

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
fs-1
"
>

📦

</div>

@endif



<div
style="
position:absolute;
top:16px;
right:16px;
"
>

<span

class="
badge

{{

$item->status==='available'

?

'bg-success'

:

'bg-danger'

}}

"

>

{{ strtoupper($item->status) }}

</span>

</div>

</div>



<div class="card-body p-4">

<h4
class="
fw-bold
mb-2
"
>

{{ $item->title }}

</h4>

<p
class="
text-secondary
small
"
>

{{

Str::limit(

$item->description,

90

)

}}

</p>



<div
class="
d-flex
justify-content-between
align-items-center
mt-4
"
>

<div>

<div
class="
fw-bold
text-primary
fs-3
"
>

{{ number_format(

$item->price_per_day,

0

) }}

zł

</div>

<div
class="
small
text-secondary
"
>

per day

</div>

</div>

<div
class="
text-end
small
text-secondary
"
>

📍

{{

$item->location

}}

</div>

</div>



<hr>



<div
class="
d-flex
align-items-center
gap-3
"
>

@if($item->owner->avatar)

<img

src="{{

asset(

'storage/'.

$item->owner->avatar

)

}}"

style="
width:48px;
height:48px;

border-radius:50%;

object-fit:cover;
"

>

@else

<div
style="
width:48px;
height:48px;

border-radius:50%;

background:#2563eb;

display:flex;
align-items:center;
justify-content:center;

color:white;
font-weight:700;
"
>

{{

strtoupper(

substr(

$item->owner->name,

0,

1

)

)

}}

</div>

@endif



<div>

<div
class="
fw-semibold
"
>

{{

$item->owner->name

}}

</div>

<div
class="
small
text-secondary
"
>

Marketplace User

</div>

</div>

</div>



<a

href="{{ route(

'items.show',

$item

) }}"

class="
btn
btn-primary
rounded-4
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

<div
style="
font-size:70px;
"
>

📭

</div>

<h2>

No items found

</h2>

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
flex-column
align-items-center
gap-3
"
>

<div
class="
text-secondary
small
fw-semibold
"
>

Showing

{{ $items->firstItem() }}

-

{{ $items->lastItem() }}

of

{{ $items->total() }}

items

</div>


<div>

{{ $items->withQueryString()->links() }}

</div>

</div>



<style>

.pagination{

gap:10px;

margin:0;

}

.pagination .page-item .page-link{

border:none;

width:48px;

height:48px;

display:flex;

align-items:center;

justify-content:center;

border-radius:16px;

background:#fff;

color:#1e293b;

font-weight:700;

box-shadow:

0 4px 12px rgba(0,0,0,.06);

transition:.2s;

}

.pagination .page-item .page-link:hover{

transform:translateY(-2px);

background:#2563eb;

color:white;

}

.pagination .page-item.active .page-link{

background:

linear-gradient(

135deg,

#2563eb,

#1d4ed8

);

color:white;

box-shadow:

0 10px 25px rgba(37,99,235,.35);

}

.pagination .page-item.disabled .page-link{

opacity:.35;

background:#f1f5f9;

}

</style>

</div>



<style>

.market-card{

transition:.25s;

}

.market-card:hover{

transform:

translateY(-8px);

box-shadow:

0 20px 45px rgba(0,0,0,.12);

}

</style>

</x-app-layout>
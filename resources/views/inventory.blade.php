<x-app-layout>

<div class="container py-5">

<div
class="
d-flex
justify-content-between
align-items-center
mb-5
"
>

<div>

<h1
class="
fw-bold
mb-1
"
>

Inventory

</h1>

<div class="text-secondary">

Manage your marketplace listings

</div>

</div>

<a

href="{{ route('items.create') }}"

class="
btn
btn-primary
btn-lg
rounded-4
px-4
"

>

＋ Add Item

</a>

</div>



<div class="row g-4 mb-5">

<div class="col-md-4">

<div
class="
card
border-0
shadow-sm
rounded-5
h-100
"
>

<div class="card-body p-4">

<div class="text-secondary">

Total Items

</div>

<h1
class="
fw-bold
text-primary
mt-2
"
>

{{ $items->count() }}

</h1>

</div>

</div>

</div>



<div class="col-md-4">

<div
class="
card
border-0
shadow-sm
rounded-5
h-100
"
>

<div class="card-body p-4">

<div class="text-secondary">

Available

</div>

<h1
class="
fw-bold
text-success
mt-2
"
>

{{

$items
->where(
'status',
'available'
)
->count()

}}

</h1>

</div>

</div>

</div>



<div class="col-md-4">

<div
class="
card
border-0
shadow-sm
rounded-5
h-100
"
>

<div class="card-body p-4">

<div class="text-secondary">

Rented

</div>

<h1
class="
fw-bold
text-warning
mt-2
"
>

{{

$items
->where(
'status',
'rented'
)
->count()

}}

</h1>

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
overflow-hidden
"
>

<div class="card-body p-4">

<div
class="
d-flex
justify-content-between
align-items-center
mb-4
"
>

<h3
class="
fw-bold
mb-0
"
>

Your Listings

</h3>

<div class="text-secondary">

{{ $items->count() }}

items

</div>

</div>



@if($items->count())

<div class="row g-4">

@foreach($items as $item)

<div class="col-md-6 col-xl-4">

<div
class="
card
border-0
shadow-sm
rounded-5
overflow-hidden
h-100
inventory-card
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

src="{{
str_contains(
$item->image,
'http'
)
?
$item->image
:
asset(
'storage/'.
$item->image
)
}}"

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
fs-2
"
>

📦

</div>

@endif

</div>



<div class="card-body">

<div
class="
d-flex
justify-content-between
mb-3
"
>

<h5
class="
fw-bold
mb-0
"
>

{{ $item->title }}

</h5>

<span

class="
badge

{{
$item->status
===
'available'
?
'bg-success'
:
'bg-warning'
}}

"

>

{{

strtoupper(
$item->status
)

}}

</span>

</div>



<p
class="
small
text-secondary
mb-3
"
>

{{

Str::limit(

$item->description,

80

)

}}

</p>



<div
class="
fw-bold
text-primary
fs-4
mb-3
"
>

{{

number_format(

$item->price_per_day,

0

)

}}

zł

<span
class="
text-secondary
fs-6
fw-normal
"
>

/day

</span>

</div>



<div
class="
small
text-secondary
mb-4
"
>

📍

{{ $item->location }}

</div>



<div
class="
d-flex
gap-2
"
>

<a

href="{{
route(
'items.show',
$item
)
}}"

class="
btn
btn-primary
flex-grow-1
rounded-4
"

>

View

</a>



<a

href="{{
route(
'items.edit',
$item
)
}}"

class="
btn
btn-outline-dark
rounded-4
"

>

Edit

</a>



<form

action="{{
route(
'items.destroy',
$item
)
}}"

method="POST"

onsubmit="return confirm(

'Delete this item?'

)"

>

@csrf

@method('DELETE')

<button

class="
btn
btn-danger
rounded-4
"

>

Delete

</button>

</form>

</div>

</div>

</div>

</div>

@endforeach

</div>

@else

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

📦

</div>

<h3
class="
fw-bold
mt-3
"
>

No listings yet

</h3>

<p class="text-secondary">

Create your first marketplace item.

</p>

<a

href="{{ route('items.create') }}"

class="
btn
btn-primary
rounded-4
px-4
"

>

Create Listing

</a>

</div>

@endif

</div>

</div>

</div>



<style>

.inventory-card{

transition:.25s;

}

.inventory-card:hover{

transform:
translateY(-8px);

box-shadow:
0 18px 45px rgba(
0,
0,
0,
.12
);

}

</style>

</x-app-layout>
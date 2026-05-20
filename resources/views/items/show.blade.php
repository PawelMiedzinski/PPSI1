<x-app-layout>

<div class="container py-5">

<div class="row g-5">

<div class="col-lg-7">

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
style="
height:520px;
background:#e2e8f0;
"
>

@if($item->image)

<img

src="{{ asset('storage/'.$item->image) }}"

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

📦 No image

</div>

@endif

</div>

</div>

</div>



<div class="col-lg-5">

<div
class="
card
border-0
shadow-lg
rounded-5
p-5
sticky-top
"
style="top:100px;"
>

<div
class="
d-flex
justify-content-between
align-items-start
mb-3
"
>

<h1
class="
fw-bold
mb-0
"
>

{{ $item->title }}

</h1>

<span

class="
badge
fs-6

{{

$item->status=='available'

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


<div
class="
text-primary
fw-bold
display-5
mb-3
"
>

{{ number_format(

$item->price_per_day,

0

) }}

zł

<span
class="
fs-5
text-secondary
fw-normal
"
>

/ day

</span>

</div>


<div
class="
d-flex
gap-4
text-secondary
mb-4
"
>

<div>

📍

{{ $item->location }}

</div>

<div>

📦

{{ $item->category->name }}

</div>

</div>


<hr>


<div
class="
d-flex
align-items-center
gap-3
mb-4
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
width:70px;
height:70px;

border-radius:50%;

object-fit:cover;
"

>

@else

<div
style="
width:70px;
height:70px;

background:#2563eb;

border-radius:50%;

display:flex;
align-items:center;
justify-content:center;

font-size:28px;

font-weight:700;

color:white;
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
fw-bold
fs-5
"
>

{{ $item->owner->name }}

</div>

<div class="text-secondary">

Marketplace User

</div>

@if($item->owner->city)

<div class="small text-secondary">

📍 {{ $item->owner->city }}

</div>

@endif

</div>

</div>


@if(

Auth::check()

&&

Auth::id()

!==

$item->owner_id

)

<button
class="
btn
btn-primary
btn-lg
rounded-4
w-100
mb-3
"
>

Rent Now

</button>

<button
class="
btn
btn-outline-dark
btn-lg
rounded-4
w-100
"
>

Message Owner

</button>

@elseif(

Auth::check()

&&

Auth::id()

===

$item->owner_id

)

<a

href="{{ route(

'items.edit',

$item

) }}"

class="
btn
btn-warning
btn-lg
rounded-4
w-100
"

>

Edit Listing

</a>

@endif


</div>

</div>

</div>



<div class="row mt-5">

<div class="col-lg-8">

<div
class="
card
border-0
shadow-sm
rounded-5
"
>

<div class="card-body p-5">

<h3
class="
fw-bold
mb-4
"
>

Description

</h3>

<p
style="
line-height:1.9;
font-size:17px;
"
>

{{ $item->description }}

</p>

</div>

</div>

</div>



<div class="col-lg-4">

<div
class="
card
border-0
shadow-sm
rounded-5
"
>

<div class="card-body p-4">

<h4
class="
fw-bold
mb-4
"
>

Rental Info

</h4>

<div
class="
d-flex
justify-content-between
mb-3
"
>

<span>

Availability

</span>

<strong>

{{ ucfirst($item->status) }}

</strong>

</div>


<div
class="
d-flex
justify-content-between
mb-3
"
>

<span>

Daily Price

</span>

<strong>

{{

number_format(

$item->price_per_day,

0

)

}}

zł

</strong>

</div>


<div
class="
d-flex
justify-content-between
"
>

<span>

Owner

</span>

<strong>

{{

$item->owner->name

}}

</strong>

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
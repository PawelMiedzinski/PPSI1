<x-app-layout>

<div
class="container py-5"
style="
background:
linear-gradient(
180deg,
#eef2f7,
#f8fafc
);
"
>

<div class="row g-5">

<div class="col-lg-7">

<div
class="
card
border-0
shadow-lg
rounded-5
overflow-hidden
mb-4
"
>

<div
style="
height:460px;

background:
linear-gradient(
135deg,
#edf2f7,
#f8fafc
);

overflow:hidden;
"
>

@if($item->image)

<img

src="{{ asset('storage/'.$item->image) }}"

style="
width:100%;
height:100%;

object-fit:cover;

transition:.4s;
"

onmouseover="
this.style.transform='scale(1.03)'
"

onmouseout="
this.style.transform='scale(1)'
"

>

@else

<div
class="
h-100
d-flex
flex-column
justify-content-center
align-items-center
"
>

<div
style="
font-size:85px;
opacity:.35;
"
>

📦

</div>

<div
class="
fw-bold
fs-3
mt-3
text-dark
"
>

No photos uploaded

</div>

<div class="text-secondary">

Owner has not added images yet

</div>

</div>

@endif

</div>

</div>



<div
class="
card
border-0
shadow-sm
rounded-5
p-4
"
>

<div class="row text-center g-3">

<div class="col-3">

<div
class="
bg-light
rounded-4
p-3
h-100
"
>

<div class="fs-3">📍</div>

<div class="small text-secondary">

Location

</div>

<div class="fw-bold">

{{ $item->location }}

</div>

</div>

</div>


<div class="col-3">

<div
class="
bg-light
rounded-4
p-3
h-100
"
>

<div class="fs-3">📦</div>

<div class="small text-secondary">

Category

</div>

<div class="fw-bold">

{{ $item->category->name }}

</div>

</div>

</div>


<div class="col-3">

<div
class="
bg-light
rounded-4
p-3
h-100
"
>

<div class="fs-3">⭐</div>

<div class="small text-secondary">

Rating

</div>

<div class="fw-bold">

5.0

</div>

</div>

</div>


<div class="col-3">

<div
class="
bg-light
rounded-4
p-3
h-100
"
>

<div class="fs-3">🔒</div>

<div class="small text-secondary">

Protection

</div>

<div class="fw-bold">

Included

</div>

</div>

</div>

</div>

</div>

</div>



<div class="col-lg-5">

<div style="position:relative;">

<div

style="
position:absolute;

inset:-30px;

background:

radial-gradient(
#2563eb25,
transparent
);

filter:blur(80px);

z-index:0;
"

>

</div>

<div

class="
card
border-0
shadow-lg
rounded-5
p-4
"

style="
position:sticky;
top:100px;

z-index:2;
"

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
rounded-pill
px-3
py-2

{{

$item->status=='available'

?

'bg-success'

:

'bg-danger'

}}

"

>

{{ ucfirst($item->status) }}

</span>

</div>


<div

class="
display-4
fw-bold
mb-2
"

style="
background:
linear-gradient(
135deg,
#2563eb,
#60a5fa
);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
"

>

{{ number_format($item->price_per_day,0) }}

zł

<span
class="
fs-5
fw-normal
text-secondary
"
>

/ day

</span>

</div>


<div
class="
small
text-secondary
mb-4
"
>

📈 Trending item

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

📍 {{ $item->location }}

</div>

<div>

📦 {{ $item->category->name }}

</div>

</div>

<hr>


<div
class="
bg-light
rounded-5
p-4
mb-4
"
>

<div
class="
d-flex
align-items-center
gap-3
"
>

@if($item->owner->avatar)

<img

src="{{ asset('storage/'.$item->owner->avatar) }}"

style="
width:72px;
height:72px;

border-radius:50%;

object-fit:cover;
"

>

@else

<div

class="
rounded-circle
text-white
fw-bold

d-flex
justify-content-center
align-items-center
"

style="
width:72px;
height:72px;

font-size:28px;

background:
linear-gradient(
135deg,
#2563eb,
#60a5fa
);
"

>

{{ strtoupper(substr($item->owner->name,0,1)) }}

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

<div
class="
small
text-warning
fw-semibold
"
>

★★★★★ 5.0

</div>

<div
class="
small
text-success
fw-semibold
"
>

✓ Verified profile

</div>

</div>

</div>

</div>


<div
class="
small
text-secondary
mb-4
"
>

✓ Secure rental process

<br>

✓ Damage protection

<br>

✓ Marketplace support

</div>


@if(Auth::check() && Auth::id() !== $item->owner_id)

<a

href="{{ route('rentals.create',$item) }}"

class="
btn
btn-primary

rounded-4

w-100

mb-3

d-flex
align-items-center
justify-content-center

fw-semibold
"

style="
height:56px;
font-size:18px;
"

>

Rent Now

</a>


<button

class="
btn
btn-outline-dark

rounded-4

w-100

fw-semibold
"

style="
height:56px;
font-size:18px;
"

>

Message Owner

</button>

@endif


@if(Auth::check() && Auth::id() === $item->owner_id)

<a

href="{{ route('items.edit',$item) }}"

class="
btn
btn-warning
w-100
rounded-4
fw-semibold
"

style="
height:56px;

display:flex;

align-items:center;

justify-content:center;
"

>

Edit Listing

</a>

@endif

</div>

</div>

</div>

</div>



<div class="row mt-5">

<div class="col-12">

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
line-height:2;
font-size:17px;
"
>

{{ $item->description }}

</p>


<hr class="my-5">


<h4
class="
fw-bold
mb-4
"
>

Rental Details

</h4>

<div class="row g-4">

<div class="col-md-3">

<div class="bg-light rounded-4 p-4 text-center">

<div class="text-secondary">

Status

</div>

<div class="fw-bold mt-2">

{{ strtoupper($item->status) }}

</div>

</div>

</div>


<div class="col-md-3">

<div class="bg-light rounded-4 p-4 text-center">

<div class="text-secondary">

Price

</div>

<div
class="
fw-bold
text-primary
mt-2
"
>

{{ number_format($item->price_per_day,0) }} zł

</div>

</div>

</div>


<div class="col-md-3">

<div class="bg-light rounded-4 p-4 text-center">

<div class="text-secondary">

Category

</div>

<div class="fw-bold mt-2">

{{ $item->category->name }}

</div>

</div>

</div>


<div class="col-md-3">

<div class="bg-light rounded-4 p-4 text-center">

<div class="text-secondary">

Owner

</div>

<div class="fw-bold mt-2">

{{ $item->owner->name }}

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
<x-app-layout>

<div class="container py-5">

<form
method="GET"
class="
card
border-0
shadow-sm
rounded-5
p-4
mb-5
"
>

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
{{ request('status')=='available'?'selected':'' }}
>

Available

</option>

<option
value="rented"
{{ request('status')=='rented'?'selected':'' }}
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
overflow:hidden;
"
>

<img

src="{{

$item->image

?

(
Str::startsWith(
$item->image,
['http://','https://']
)

?

$item->image

:

asset(
'storage/'.$item->image
)

)

:

'https://picsum.photos/600/400?random='.$item->id

}}"

style="
width:100%;
height:100%;
object-fit:cover;
"

loading="lazy"

onerror="
this.onerror=null;
this.src='https://picsum.photos/600/400?random={{ $item->id + 999 }}';
"

>

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

📍 {{ $item->location }}

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

src="{{ asset(
'storage/'.$item->owner->avatar
) }}"

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

{{ strtoupper(
substr(
$item->owner->name,
0,
1
)
) }}

</div>

@endif

<div>

<div
class="
fw-semibold
"
>

{{ $item->owner->name }}

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

font-weight:700;

}

</style>

</x-app-layout>
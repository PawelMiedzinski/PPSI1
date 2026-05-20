<x-app-layout>

<div class="container py-5">

<div class="mb-5">

<h1
class="
fw-bold
mb-2
"
>

Rentals

</h1>

<p class="text-secondary">

Manage your active rentals and history.

</p>

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

Active Rentals

</div>

<h1
class="
fw-bold
text-primary
mt-2
"
>

{{ $activeRentals->count() }}

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

Current Balance

</div>

<h1
class="
fw-bold
text-danger
mt-2
"
>

{{

number_format(

$activeRentals

->sum(

'total_price'

),

0

)

}}

zł

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

Lifetime Spent

</div>

<h1
class="
fw-bold
text-success
mt-2
"
>

{{

number_format(

$history

->where(

'status',

'returned'

)

->sum(

'total_price'

),

0

)

}}

zł

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
mb-5
"
>

<div class="card-body p-4">

<h3
class="
fw-bold
mb-4
"
>

Active Rentals

</h3>

@if($activeRentals->count())

<div class="row g-4">

@foreach($activeRentals as $rental)

<div class="col-lg-6">

<div
class="
card
border
rounded-5
h-100
"
>

<div class="card-body p-4">

<div
class="
d-flex
justify-content-between
align-items-start
mb-3
"
>

<div>

<h5
class="
fw-bold
mb-1
"
>

{{ $rental->item->title }}

</h5>

<div class="text-secondary">

Owner:

{{

$rental

->item

->owner

->name

}}

</div>

</div>


<span
class="
badge
bg-primary
"
>

ACTIVE

</span>

</div>


<div class="mb-3">

<div>

Price:

<strong>

{{

number_format(

$rental->item->price_per_day,

0

)

}}

zł/day

</strong>

</div>

<div>

Total:

<strong>

{{

number_format(

$rental->total_price,

0

)

}}

zł

</strong>

</div>

</div>


<div
class="
d-flex
gap-2
"
>

<form

method="POST"

action="/rentals/{{ $rental->id }}/return"

>

@csrf

@method('PATCH')

<button
class="
btn
btn-success
rounded-4
"
>

Return

</button>

</form>


<form

method="POST"

action="/rentals/{{ $rental->id }}/cancel"

>

@csrf

@method('PATCH')

<button
class="
btn
btn-outline-danger
rounded-4
"
>

Cancel

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
font-size:60px;
"
>

📭

</div>

<h4>

No active rentals

</h4>

<p class="text-secondary">

Browse marketplace and rent something.

</p>

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
"
>

<div class="card-body p-4">

<h3
class="
fw-bold
mb-4
"
>

Rental History

</h3>

@if($history->count())

<div
class="
table-responsive
"
>

<table
class="
table
align-middle
"
>

<thead>

<tr>

<th>

Item

</th>

<th>

Status

</th>

<th>

Price

</th>

</tr>

</thead>

<tbody>

@foreach($history as $rental)

<tr>

<td>

{{

$rental

->item

->title

}}

</td>

<td>

<span

class="
badge

{{

$rental->status

==='returned'

?

'bg-success'

:

'bg-danger'

}}

"

>

{{

strtoupper(

$rental->status

)

}}

</span>

</td>

<td>

{{

number_format(

$rental->total_price,

0

)

}}

zł

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@else

<div
class="
text-center
py-4
"
>

No history yet.

</div>

@endif

</div>

</div>

</div>

</x-app-layout>
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

📦 Manage Items

</h1>

<div class="text-secondary">

Marketplace listing administration

</div>

</div>

<a

href="{{ route('admin.dashboard') }}"

class="
btn
btn-outline-dark
rounded-4
px-4
"

>

← Back

</a>

</div>



<div
class="
card
border-0
shadow-lg
rounded-5
overflow-hidden
"
>

<div class="card-body p-0">

<table
class="
table
align-middle
mb-0
"
>

<thead>

<tr>

<th class="ps-4">

Item

</th>

<th>

Owner

</th>

<th>

Price

</th>

<th>

Status

</th>

<th>

Location

</th>

<th
class="text-end pe-4"
>

Actions

</th>

</tr>

</thead>

<tbody>

@foreach($items as $item)

<tr>

<td class="ps-4">

<div
class="
d-flex
align-items-center
gap-3
"
>

<div

style="
width:80px;
height:60px;

overflow:hidden;

border-radius:18px;

background:#e2e8f0;

flex-shrink:0;
"

>

@if($item->image)

<img

src="{{

Str::startsWith(

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
"

>

📦

</div>

@endif

</div>

<div>

<div
class="
fw-bold
"
>

{{ $item->title }}

</div>

<div
class="
small
text-secondary
"
>

ID:

{{ $item->id }}

</div>

</div>

</div>

</td>



<td>

<a

href="/users/{{ $item->owner->id }}"

class="
text-decoration-none
fw-bold
"

>

{{ $item->owner->name }}

</a>

</td>



<td>

<div
class="
fw-bold
text-primary
"
>

{{ number_format(

$item->price_per_day,

0

) }}

zł/day

</div>

</td>



<td>

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

{{ strtoupper(

$item->status

) }}

</span>

</td>



<td>

{{

$item->location

??

'Unknown'

}}

</td>



<td class="text-end pe-4">

<div
class="
d-flex
justify-content-end
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
btn-outline-primary
rounded-4
"

>

Open

</a>


<form

method="POST"

action="{{

route(

'admin.items.destroy',

$item

)

}}"

>

@csrf

@method('DELETE')

<button

onclick="return confirm(

'Delete this listing?'

)"

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

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>



<div class="mt-4">

{{ $items->links() }}

</div>

</div>

</x-app-layout>
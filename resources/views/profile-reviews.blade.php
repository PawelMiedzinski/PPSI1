<x-app-layout>

<div class="container py-5">

<div class="mb-5">

<h1
class="
fw-bold
mb-2
"
>

{{ $user->name }} Reviews

</h1>

<p class="text-secondary">

Community feedback and ratings

</p>

</div>


@if($reviews->count())

<div class="row g-4">

@foreach($reviews as $review)

<div class="col-lg-6">

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

<div
class="
d-flex
justify-content-between
align-items-start
mb-4
"
>

<a

href="/users/{{ $review->reviewer->id }}"

class="
text-decoration-none
text-dark
"

>

<div
class="
d-flex
align-items-center
gap-3
"
>

<div
class="
rounded-circle
overflow-hidden
shadow-sm
border
border-2
border-light
"

style="
width:62px;
height:62px;
flex-shrink:0;
"
>

@if($review->reviewer->avatar)

<img

src="{{ asset('storage/'.$review->reviewer->avatar) }}"

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
align-items-center
justify-content-center
fw-bold
text-white
"

style="
width:100%;
height:100%;

font-size:24px;

background:
linear-gradient(
135deg,
#2563eb,
#1d4ed8
);
"

>

{{ strtoupper(substr($review->reviewer->name,0,1)) }}

</div>

@endif

</div>


<div>

<div
class="
fw-bold
fs-5
"
>

{{ $review->reviewer->name }}

</div>

<div
class="
small
text-secondary
"
>

{{ $review->created_at->diffForHumans() }}

</div>

</div>

</div>

</a>


<div
class="
fs-3
fw-bold
text-warning
"
>

⭐ {{ $review->rating }}

</div>

</div>


@if($review->item)

<div
class="
small
text-secondary
mb-3
"
>

Rental:

<a

href="/items/{{ $review->item->id }}"

class="
text-decoration-none
fw-semibold
"

>

{{ $review->item->title }}

</a>

</div>

@endif


<div
class="
bg-light
rounded-4
p-3
"
>

{{ $review->comment }}

</div>

</div>

</div>

</div>

@endforeach

</div>

@else

<div
class="
card
border-0
shadow-sm
rounded-5
"
>

<div
class="
card-body
text-center
py-5
"
>

<div
style="
font-size:60px;
"
>

⭐

</div>

<h3>

No reviews yet

</h3>

<p class="text-secondary">

This user has not received community feedback yet.

</p>

</div>

</div>

@endif

</div>

</x-app-layout>
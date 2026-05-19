<x-app-layout>

<div class="container py-5">

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
height:260px;
position:relative;
overflow:hidden;
"
>

@if(Auth::user()->banner)

<img
src="{{ asset('storage/' . Auth::user()->banner) }}"
style="
width:100%;
height:100%;
object-fit:cover;
"
>

@else

<div
style="
height:100%;

background:
linear-gradient(
135deg,
#2563eb,
#1e40af,
#0f172a
);

"
>

<div
style="
position:absolute;
right:50px;
top:20px;

font-size:120px;
font-weight:900;

opacity:.08;
color:white;
"
>

MR

</div>

</div>

@endif

</div>


<div
class="
card-body
px-5
pb-5
"
>

<div
class="
row
align-items-end
gx-5
"
>

<div class="col-lg-auto">

<div
class="
shadow-lg
border
border-5
border-white
overflow-hidden
rounded-circle
bg-white
"
style="
width:170px;
height:170px;
margin-top:-90px;
"
>

@if(Auth::user()->avatar)

<img
src="{{ asset('storage/' . Auth::user()->avatar) }}"
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

font-size:60px;

background:
linear-gradient(
135deg,
#2563eb,
#1d4ed8
);
"
>

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

@endif

</div>

</div>


<div class="col">

<h1
class="
fw-bold
mb-2
"
>

{{ Auth::user()->name }}

</h1>

<div
class="
d-flex
gap-2
flex-wrap
mb-3
"
>

<span
class="
badge
bg-primary
px-3
py-2
"
>

Verified Marketplace User

</span>

<span
class="
badge
bg-dark
px-3
py-2
"
>

Member since {{ Auth::user()->created_at->format('Y') }}

</span>

</div>

<p class="text-secondary mb-1">

📍 {{ Auth::user()->city ?? 'Location not set' }}

</p>

<p class="text-secondary">

{{ Auth::user()->bio ?? 'No bio yet.' }}

</p>

</div>


<div class="col-lg-auto">

<a
href="/settings"
class="
btn
btn-primary
btn-lg
px-4
"
>

<i class="bi bi-gear"></i>

Settings

</a>

</div>

</div>

</div>

</div>



<div class="row g-4 mt-2">

<div class="col-md-3">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body">

<h2>

{{ Auth::user()->items()->count() }}

</h2>

<div class="text-secondary">

Items

</div>

</div>

</div>

</div>


<div class="col-md-3">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body">

<h2>

{{ Auth::user()->rentals()->count() }}

</h2>

<div class="text-secondary">

Rentals

</div>

</div>

</div>

</div>


<div class="col-md-3">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body">

<h2>

5.0

</h2>

<div class="text-secondary">

Rating

</div>

</div>

</div>

</div>


<div class="col-md-3">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body">

<h2>

100%

</h2>

<div class="text-secondary">

Trust Score

</div>

</div>

</div>

</div>

</div>



<div class="row mt-4 g-4">

<div class="col-lg-7">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body p-4">

<h4>

About User

</h4>

<hr>

<p>

{{ Auth::user()->bio ?? 'No information provided.' }}

</p>

</div>

</div>

</div>


<div class="col-lg-5">

<div
class="
card
shadow-sm
border-0
rounded-4
"
>

<div class="card-body p-4">

<h4>

Recent Activity

</h4>

<hr>

<div>

📦 Listed new item

</div>

<div>

⭐ Account verified

</div>

<div>

🚲 Rental completed

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
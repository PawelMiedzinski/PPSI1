<x-app-layout>

<x-slot name="header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2 class="fw-bold mb-1">

Dashboard

</h2>

<small class="text-secondary">

Welcome back,
{{ Auth::user()->name }}

</small>

</div>

<div>

<span
class="
badge
bg-primary
fs-6
px-3
py-2
rounded-pill
shadow-sm
"
>

🔥 Marketplace Online

</span>

</div>

</div>

</div>

</x-slot>


<div class="container py-5 dashboard-background">


<div
class="
card
border-0
shadow-lg
mb-5
overflow-hidden
dashboard-card
"
>

<div

class="
card-body
p-5
text-white
"

style="
background:
linear-gradient(
135deg,
#2563eb,
#1e40af,
#1e3a8a
);
"

>

<div class="row align-items-center">

<div class="col-lg-8">

<div
class="
badge
bg-light
text-primary
mb-3
px-3
py-2
"
>

MULTIRENTAL PLATFORM

</div>

<h1
class="
display-4
fw-bold
mb-3
"
>

Manage your rental empire.

</h1>

<p
class="
lead
opacity-75
"
>

Track rentals.
Manage inventory.
Scale your marketplace.

</p>

<div
class="
d-flex
gap-3
mt-4
flex-wrap
"
>

<a

href="/items"

class="
btn
btn-light
btn-lg
rounded-pill
px-4
"

>

Browse Items

</a>

<a

href="/inventory"

class="
btn
btn-outline-light
btn-lg
rounded-pill
px-4
"

>

My Listings

</a>

</div>

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
font-size:130px;
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


<div class="row g-4 mb-5">


<div class="col-lg-3">

<div
class="
card
dashboard-card
border-0
shadow-sm
h-100
"
>

<div class="card-body">

<i
class="
bi
bi-box-seam
text-primary
fs-2
"
></i>

<div
class="
display-5
fw-bold
mt-3
"
>

{{ $itemsCount }}

</div>

<div class="text-secondary">

My Items

</div>

</div>

</div>

</div>


<div class="col-lg-3">

<div
class="
card
dashboard-card
border-0
shadow-sm
h-100
"
>

<div class="card-body">

<i
class="
bi
bi-calendar-check
text-success
fs-2
"
></i>

<div
class="
display-5
fw-bold
mt-3
"
>

{{ $activeRentals }}

</div>

<div class="text-secondary">

Active Rentals

</div>

</div>

</div>

</div>


<div class="col-lg-3">

<div
class="
card
dashboard-card
border-0
shadow-sm
h-100
"
>

<div class="card-body">

<i
class="
bi
bi-arrow-repeat
text-info
fs-2
"
></i>

<div
class="
display-5
fw-bold
mt-3
"
>

{{ $returnedRentals }}

</div>

<div class="text-secondary">

Returned

</div>

</div>

</div>

</div>


<div class="col-lg-3">

<div
class="
card
dashboard-card
border-0
shadow-sm
h-100
"
>

<div class="card-body">

<i
class="
bi
bi-x-circle
text-danger
fs-2
"
></i>

<div
class="
display-5
fw-bold
mt-3
"
>

{{ $cancelledRentals }}

</div>

<div class="text-secondary">

Cancelled

</div>

</div>

</div>

</div>

</div>



<div class="row g-4">


<div class="col-lg-7">

<div
class="
card
dashboard-card
border-0
shadow-sm
"
>

<div class="card-body p-4">

<h4
class="
fw-bold
mb-4
"
>

Quick Actions

</h4>

<div
class="
row
g-3
"
>

<div class="col-md-6">

<a

href="/items"

class="
btn
btn-primary
w-100
py-3
rounded-4
"

>

Browse Marketplace

</a>

</div>

<div class="col-md-6">

<a

href="/profile"

class="
btn
btn-dark
w-100
py-3
rounded-4
"

>

Edit Profile

</a>

</div>

<div class="col-md-6">

<a

href="/inventory"

class="
btn
btn-outline-primary
w-100
py-3
rounded-4
"

>

Manage Listings

</a>

</div>

<div class="col-md-6">

<a

href="/rentals"

class="
btn
btn-outline-primary
w-100
py-3
rounded-4
"

>

View Rentals

</a>

</div>

</div>

</div>

</div>

</div>


<div class="col-lg-5">

<div
class="
card
dashboard-card
border-0
shadow-sm
"
>

<div class="card-body p-4">

<h4
class="
fw-bold
mb-4
"
>

Recent Activity

</h4>

<div class="mb-3">

📦 Camera listed

</div>

<div class="mb-3">

🚲 Bike rented

</div>

<div class="mb-3">

✅ Laptop returned

</div>

<div>

⭐ Marketplace healthy

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
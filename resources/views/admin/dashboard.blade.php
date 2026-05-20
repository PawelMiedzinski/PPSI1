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

🛡 Admin Panel

</h1>

<div class="text-secondary">

Marketplace administration center

</div>

</div>

<div>

<span
class="
badge
bg-danger
px-4
py-3
fs-6
rounded-pill
"
>

ADMIN ACCESS

</span>

</div>

</div>



<div class="row g-4 mb-5">

<div class="col-md-3">

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

Users

</div>

<h1
class="
fw-bold
text-primary
mt-2
"
>

{{ $usersCount }}

</h1>

</div>

</div>

</div>



<div class="col-md-3">

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

Items

</div>

<h1
class="
fw-bold
text-success
mt-2
"
>

{{ $itemsCount }}

</h1>

</div>

</div>

</div>



<div class="col-md-3">

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

Rentals

</div>

<h1
class="
fw-bold
text-warning
mt-2
"
>

{{ $rentalsCount }}

</h1>

</div>

</div>

</div>



<div class="col-md-3">

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

Banned Users

</div>

<h1
class="
fw-bold
text-danger
mt-2
"
>

{{ $bannedUsers }}

</h1>

</div>

</div>

</div>

</div>



<div class="row g-4">

<div class="col-lg-6">

<a

href="{{ route('admin.users') }}"

class="
text-decoration-none
"

>

<div
class="
card
border-0
shadow-lg
rounded-5
admin-card
h-100
"
>

<div class="card-body p-5">

<div
style="
font-size:60px;
"
>

👥

</div>

<h3
class="
fw-bold
mt-3
"
>

Manage Users

</h3>

<p class="text-secondary">

Ban users.

Open profiles.

Moderate marketplace activity.

</p>

</div>

</div>

</a>

</div>



<div class="col-lg-6">

<a

href="{{ route('admin.items') }}"

class="
text-decoration-none
"

>

<div
class="
card
border-0
shadow-lg
rounded-5
admin-card
h-100
"
>

<div class="card-body p-5">

<div
style="
font-size:60px;
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

Manage Items

</h3>

<p class="text-secondary">

Delete listings.

Inspect marketplace content.

Moderate inventory.

</p>

</div>

</div>

</a>

</div>

</div>

</div>



<style>

.admin-card{

transition:.25s;

cursor:pointer;

}

.admin-card:hover{

transform:

translateY(-8px);

box-shadow:

0 18px 45px rgba(

37,
99,
235,
0.15

)!important;

}

</style>

</x-app-layout>
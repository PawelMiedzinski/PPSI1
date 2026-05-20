<x-guest-layout>

<div
class="
container-fluid
min-vh-100
"
>

<div class="row min-vh-100">

<div
class="
col-lg-7
d-none
d-lg-flex
flex-column
justify-content-center
px-5
text-white
"
style="
background:
linear-gradient(
135deg,
#2563eb,
#1e3a8a,
#0f172a
);
"
>

<div style="max-width:600px;">

<div
class="
d-flex
align-items-center
gap-3
mb-5
"
>

<div
style="
width:80px;
height:80px;

background:#2563eb;

border-radius:24px;

display:flex;
align-items:center;
justify-content:center;

font-size:34px;
font-weight:800;
"
>

MR

</div>

<div>

<h1
class="
fw-bold
mb-0
"
>

MultiRental

</h1>

<div
style="
opacity:.8;
"
>

Marketplace platform

</div>

</div>

</div>

<h1
class="
display-3
fw-bold
mb-4
"
>

Rent anything.

</h1>

<p
class="
fs-4
opacity-75
"
>

The next generation rental marketplace.

List products.

Rent equipment.

Build trust.

</p>

</div>

</div>


<div
class="
col-lg-5
d-flex
align-items-center
justify-content-center
p-4
"
style="
background:#eef2f7;
"
>

<div
class="
card
border-0
shadow-lg
rounded-5
p-5
w-100
"
style="
max-width:520px;
"
>

<div
class="
text-center
mb-5
"
>

<h2
class="
fw-bold
"
>

Welcome back

</h2>

<p class="text-secondary">

Login to MultiRental

</p>

</div>

<x-auth-session-status
class="mb-4"
:status="session('status')"
/>

<form
method="POST"
action="{{ route('login') }}"
>

@csrf

<div class="mb-4">

<label class="mb-2">

Email

</label>

<input
name="email"
type="email"
class="
form-control
form-control-lg
"
required
>

</div>

<div class="mb-4">

<label class="mb-2">

Password

</label>

<input
name="password"
type="password"
class="
form-control
form-control-lg
"
required
>

</div>

<div
class="
d-flex
justify-content-between
mb-4
"
>

<div>

<input
type="checkbox"
name="remember"
>

Remember me

</div>

<a
href="{{ route('password.request') }}"
>

Forgot password?

</a>

</div>

<button
class="
btn
btn-primary
btn-lg
w-100
rounded-4
"
>

Login

</button>

<div
class="
text-center
mt-4
"
>

No account?

<a
href="{{ route('register') }}"
>

Create one

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</x-guest-layout>
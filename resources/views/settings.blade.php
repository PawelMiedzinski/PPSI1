<x-app-layout>

<div class="container py-5">

<div class="row g-4">

<div class="col-lg-3">

<div
class="
card
border-0
shadow-sm
rounded-4
sticky-top
"
style="top:100px;"
>

<div class="card-body">

<h5
class="
fw-bold
mb-4
"
>

Settings

</h5>

<div
class="
list-group
list-group-flush
"
>

<a
href="#profile"
class="
list-group-item
list-group-item-action
border-0
rounded-3
mb-2
active
"
>

👤 Profile

</a>

<a
href="#images"
class="
list-group-item
list-group-item-action
border-0
rounded-3
mb-2
"
>

🖼 Avatar & Banner

</a>

<a
href="#security"
class="
list-group-item
list-group-item-action
border-0
rounded-3
mb-2
"
>

🔒 Security

</a>

<a
href="#danger"
class="
list-group-item
list-group-item-action
border-0
rounded-3
text-danger
"
>

⚠ Danger Zone

</a>

</div>

</div>

</div>

</div>



<div class="col-lg-9">

<div
id="profile"
class="
card
border-0
shadow-sm
rounded-4
mb-4
"
>

<div class="card-body p-4">

<h3
class="
fw-bold
mb-4
"
>

Profile Information

</h3>

<form>

<div class="row g-4">

<div class="col-md-6">

<label class="form-label">

Display Name

</label>

<input
class="form-control"
value="{{ Auth::user()->name }}"
>

</div>


<div class="col-md-6">

<label class="form-label">

City

</label>

<input
class="form-control"
placeholder="Warsaw"
value="{{ Auth::user()->city }}"
>

</div>


<div class="col-md-6">

<label class="form-label">

Phone

</label>

<input
class="form-control"
placeholder="+48..."
value="{{ Auth::user()->phone }}"
>

</div>


<div class="col-md-6">

<label class="form-label">

Email

</label>

<input
disabled
class="form-control"
value="{{ Auth::user()->email }}"
>

</div>


<div class="col-12">

<label class="form-label">

Bio

</label>

<textarea
rows="4"
class="form-control"
>{{ Auth::user()->bio }}</textarea>

</div>

</div>

<button
class="
btn
btn-primary
mt-4
px-4
"
>

Save Changes

</button>

</form>

</div>

</div>



<div
id="images"
class="
card
border-0
shadow-sm
rounded-4
mb-4
"
>

<div class="card-body p-4">

<h3
class="
fw-bold
mb-4
"
>

Avatar & Banner

</h3>

<div class="row g-4">

<div class="col-md-6">

<label>

Avatar

</label>

<input
type="file"
class="form-control"
>

</div>

<div class="col-md-6">

<label>

Banner

</label>

<input
type="file"
class="form-control"
>

</div>

</div>

<button
class="
btn
btn-dark
mt-4
"
>

Upload Images

</button>

</div>

</div>



<div
id="security"
class="
card
border-0
shadow-sm
rounded-4
mb-4
"
>

<div class="card-body p-4">

<h3
class="
fw-bold
mb-4
"
>

Security

</h3>

<div class="mb-3">

<input
type="password"
placeholder="Current password"
class="form-control"
>

</div>

<div class="mb-3">

<input
type="password"
placeholder="New password"
class="form-control"
>

</div>

<div class="mb-3">

<input
type="password"
placeholder="Confirm password"
class="form-control"
>

</div>

<button
class="
btn
btn-primary
"
>

Update Password

</button>

</div>

</div>



<div
id="danger"
class="
card
border-danger
shadow-sm
rounded-4
"
>

<div class="card-body p-4">

<h3
class="
text-danger
fw-bold
"
>

Danger Zone

</h3>

<p class="text-secondary">

Deleting your account permanently removes listings, rentals and marketplace history.

</p>

<button
class="
btn
btn-outline-danger
"
>

Delete Account

</button>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
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

<h5 class="fw-bold mb-4">

Settings

</h5>

<div
class="list-group"
role="tablist"
>

<button
class="
list-group-item
list-group-item-action
rounded-3
mb-2
active
"
data-bs-toggle="tab"
data-bs-target="#profile"
type="button"
>

👤 Profile

</button>

<button
class="
list-group-item
list-group-item-action
rounded-3
mb-2
"
data-bs-toggle="tab"
data-bs-target="#images"
type="button"
>

🖼 Avatar & Banner

</button>

<button
class="
list-group-item
list-group-item-action
rounded-3
mb-2
"
data-bs-toggle="tab"
data-bs-target="#security"
type="button"
>

🔒 Security

</button>

<button
class="
list-group-item
list-group-item-action
rounded-3
text-danger
"
data-bs-toggle="tab"
data-bs-target="#danger"
type="button"
>

⚠ Danger Zone

</button>

</div>

</div>

</div>

</div>



<div class="col-lg-9">

<div class="tab-content">



<div
class="
tab-pane
fade
show
active
"
id="profile"
>

<div
class="
card
border-0
shadow-sm
rounded-4
"
>

<div class="card-body p-5">

<div
class="
d-flex
justify-content-between
align-items-center
mb-4
flex-wrap
gap-3
"
>

<div>

<h2 class="fw-bold mb-1">

Profile Information

</h2>

<p class="text-secondary mb-0">

Manage your marketplace identity.

</p>

</div>

@if(session('success'))

<div
class="
alert
alert-success
border-0
rounded-4
mb-0
px-4
py-3
shadow-sm
"
>

<i class="bi bi-check-circle-fill me-2"></i>

{{ session('success') }}

</div>

@endif

</div>


<form
method="POST"
action="{{ route('settings.profile') }}"
enctype="multipart/form-data"
>

@csrf

<div class="row g-4">

<div class="col-md-6">

<label class="form-label fw-semibold">

Display Name

</label>

<input
name="name"
class="
form-control
form-control-lg
rounded-4
"
value="{{ old('name',Auth::user()->name) }}"
>

</div>

<div class="col-md-6">

<label class="form-label fw-semibold">

City

</label>

<input
name="city"
class="
form-control
form-control-lg
rounded-4
"
value="{{ old('city',Auth::user()->city) }}"
>

</div>

<div class="col-md-6">

<label class="form-label fw-semibold">

Phone

</label>

<input
name="phone"
class="
form-control
form-control-lg
rounded-4
"
value="{{ old('phone',Auth::user()->phone) }}"
>

</div>

<div class="col-md-6">

<label class="form-label fw-semibold">

Email

</label>

<input
disabled
class="
form-control
form-control-lg
rounded-4
bg-light
"
value="{{ Auth::user()->email }}"
>

</div>

<div class="col-12">

<label class="form-label fw-semibold">

Bio

</label>

<textarea
name="bio"
rows="5"
class="
form-control
rounded-4
"
>{{ old('bio',Auth::user()->bio) }}</textarea>

</div>

</div>

<div class="mt-4">

<button
class="
btn
btn-primary
btn-lg
rounded-4
px-5
"
>

<i class="bi bi-save me-2"></i>

Save Changes

</button>

</div>

</form>

</div>

</div>

</div>



<div
class="
tab-pane
fade
"
id="images"
>

<div
class="
card
border-0
shadow-sm
rounded-4
"
>

<div class="card-body p-5">

<h3 class="fw-bold mb-4">

Avatar & Banner

</h3>

<p class="text-secondary">

Customize your marketplace profile.

</p>

<form
method="POST"
action="{{ route('settings.profile') }}"
enctype="multipart/form-data"
>

@csrf

<div class="row g-5 mt-2">

<div class="col-md-6">

<label class="fw-semibold mb-3">

Current Avatar

</label>

<div class="mb-3">

@if(Auth::user()->avatar)

<img

src="{{ asset('storage/' . Auth::user()->avatar) }}"

class="
rounded-circle
shadow
border
"

style="
width:120px;
height:120px;
object-fit:cover;
"
>

@else

<div
class="
rounded-circle
bg-primary
text-white
d-flex
align-items-center
justify-content-center
fw-bold
shadow
"
style="
width:120px;
height:120px;
font-size:42px;
"
>

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

@endif

</div>

<input
name="avatar"
type="file"
class="
form-control
rounded-4
"
>

</div>



<div class="col-md-6">

<label class="fw-semibold mb-3">

Current Banner

</label>

<div class="mb-3">

@if(Auth::user()->banner)

<img

src="{{ asset('storage/' . Auth::user()->banner) }}"

class="
rounded-4
shadow
w-100
"

style="
height:140px;
object-fit:cover;
"
>

@else

<div
class="
rounded-4
d-flex
align-items-center
justify-content-center
text-white
fw-bold
shadow
"
style="
height:140px;
background:
linear-gradient(
135deg,
#2563eb,
#0f172a
);
"
>

NO BANNER

</div>

@endif

</div>

<input
name="banner"
type="file"
class="
form-control
rounded-4
"
>

</div>

</div>

<button
class="
btn
btn-dark
rounded-4
mt-5
px-4
"
>

Upload Images

</button>

</form>

</div>

</div>

</div>



<div
class="
tab-pane
fade
"
id="security"
>

<div
class="
card
border-0
shadow-sm
rounded-4
"
>

<div class="card-body p-5">

<div
class="
d-flex
justify-content-between
align-items-center
mb-4
flex-wrap
gap-3
"
>

<div>

<h2
class="
fw-bold
mb-1
"
>

Security

</h2>

<p class="text-secondary mb-0">

Manage account protection and privacy.

</p>

</div>

<span
class="
badge
bg-success
px-3
py-2
fs-6
"
>

🟢 Protected

</span>

</div>


<div
class="
card
border-0
bg-light
rounded-4
mb-4
"
>

<div class="card-body">

<div
class="
d-flex
justify-content-between
align-items-center
"
>

<div>

<h5 class="fw-bold">

Password

</h5>

<p class="text-secondary mb-0">

Change your account password.

</p>

</div>

<button
class="
btn
btn-primary
"
data-bs-toggle="collapse"
data-bs-target="#passwordPanel"
>

Change Password

</button>

</div>


<div
class="
collapse
mt-4
"
id="passwordPanel"
>

<input
type="password"
class="
form-control
mb-3
"
placeholder="Current password"
>

<input
type="password"
class="
form-control
mb-3
"
placeholder="New password"
>

<input
type="password"
class="
form-control
mb-3
"
placeholder="Confirm new password"
>

<button
class="
btn
btn-dark
"
>

Update Password

</button>

</div>

</div>

</div>


<div
class="
card
border-0
bg-light
rounded-4
mb-4
"
>

<div class="card-body">

<div
class="
d-flex
justify-content-between
align-items-center
"
>

<div>

<h5 class="fw-bold">

Two Factor Authentication

</h5>

<p class="text-secondary mb-0">

Extra protection for your account.

</p>

</div>

<div
class="
form-check
form-switch
fs-5
"
>

<input
class="
form-check-input
"
type="checkbox"
>

</div>

</div>

</div>

</div>


<div
class="
card
border-0
bg-light
rounded-4
"
>

<div class="card-body">

<h5
class="
fw-bold
mb-3
"
>

Login Activity

</h5>

<div class="mb-3">

🖥 Windows · Chrome

<div class="text-secondary small">

127.0.0.1 · Active now

</div>

</div>

<div>

</div>

</div>

</div>

</div>


</div>

</div>

</div>



<div
class="
tab-pane
fade
"
id="danger"
>

<div
class="
card
border-danger
shadow-sm
rounded-4
"
>

<div class="card-body p-5">

<h3 class="text-danger fw-bold">

Danger Zone

</h3>

<p class="text-secondary">

Deleting your account permanently removes everything.

</p>

<button
class="
btn
btn-outline-danger
rounded-4
px-4
"
>

Delete Account

</button>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>
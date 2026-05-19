<nav

class="
navbar
navbar-expand-lg
shadow-sm
sticky-top
"

style="
background:
rgba(15,23,42,.92);

backdrop-filter:
blur(18px);

border-bottom:
1px solid rgba(255,255,255,.05);

"

>

<div class="container">

<a

href="{{ route('dashboard') }}"

class="
navbar-brand
d-flex
align-items-center
gap-3
"

>

<div

class="
logo-mr
rounded-4
d-flex
align-items-center
justify-content-center
shadow-lg
flex-shrink-0
"

>

<span class="logo-m">

M

</span>

<span class="logo-r">

R

</span>

</div>

<div>

<div

class="
fw-bold
fs-3
text-white
lh-1
"

>

MultiRental

</div>

<div

class="
d-none
d-xl-block
"

style="
font-size:12px;
color:#94a3b8;
"

>

Marketplace platform

</div>

</div>

</a>


<div

class="
collapse
navbar-collapse
show
"

id="nav"

>

<ul

class="
navbar-nav
mx-auto
gap-2
"

>

<li>

<a

href="/dashboard"

class="
nav-link
nav-premium
active-nav
"

>

<i class="bi bi-grid me-2"></i>

Dashboard

</a>

</li>


<li>

<a

href="/items"

class="
nav-link
nav-premium
"

>

<i class="bi bi-search me-2"></i>

Browse

</a>

</li>


<li>

<a

href="/my-items"

class="
nav-link
nav-premium
"

>

<i class="bi bi-box me-2"></i>

Inventory

</a>

</li>


<li>

<a

href="/my-rentals"

class="
nav-link
nav-premium
"

>

<i class="bi bi-calendar-check me-2"></i>

Rentals

</a>

</li>

</ul>


<div

class="
d-flex
align-items-center
gap-3
"

>

<div

class="
user-premium
d-flex
align-items-center
gap-3
"

>

<div

class="
avatar-premium
"

>

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>


<div
class="
d-none
d-xl-block
"
>

<div

class="
text-white
fw-semibold
"

>

{{ Auth::user()->name }}

</div>

<div

style="
font-size:12px;
color:#94a3b8;
"

>

Marketplace User

</div>

</div>

</div>


<div class="dropdown">

<button

class="
btn
btn-premium
dropdown-toggle
"

data-bs-toggle="dropdown"

>

Account

</button>

<ul

class="
dropdown-menu
dropdown-menu-end
shadow-lg
border-0
rounded-4
p-2
"

>

<li>

<a

class="
dropdown-item
rounded-3
"

href="/profile"

>

<i class="bi bi-person me-2"></i>

Profile

</a>

</li>

<li>

<hr class="dropdown-divider">

</li>

<li>

<form

method="POST"

action="{{ route('logout') }}"

>

@csrf

<button

class="
dropdown-item
text-danger
rounded-3
"

>

<i class="bi bi-box-arrow-right me-2"></i>

Logout

</button>

</form>

</li>

</ul>

</div>

</div>

</div>

</div>

</nav>
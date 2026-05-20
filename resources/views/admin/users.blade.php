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

👥 Manage Users

</h1>

<div class="text-secondary">

Marketplace user administration

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

User

</th>

<th>

Email

</th>

<th>

Status

</th>

<th>

Role

</th>

<th
class="text-end pe-4"
>

Actions

</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

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
width:56px;
height:56px;

border-radius:18px;

overflow:hidden;

background:#2563eb;

display:flex;
align-items:center;
justify-content:center;

color:white;
font-weight:800;
"

>

@if($user->avatar)

<img

src="{{ asset(

'storage/'.

$user->avatar

) }}"

style="
width:100%;
height:100%;
object-fit:cover;
"

>

@else

{{ strtoupper(

substr(

$user->name,

0,

1

)

) }}

@endif

</div>

<div>

<div
class="
fw-bold
"
>

{{ $user->name }}

@if($user->is_admin)

<span
class="
badge
bg-danger
ms-2
"
>

ADMIN

</span>

@endif

</div>

<div
class="
small
text-secondary
"
>

ID:

{{ $user->id }}

</div>

</div>

</div>

</td>


<td>

{{ $user->email }}

</td>


<td>

@if($user->is_banned)

<span
class="
badge
bg-danger
"
>

BANNED

</span>

@else

<span
class="
badge
bg-success
"
>

ACTIVE

</span>

@endif

</td>


<td>

@if($user->is_admin)

<span
class="
badge
bg-dark
"
>

Administrator

</span>

@else

<span
class="
badge
bg-primary
"
>

User

</span>

@endif

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

href="/users/{{ $user->id }}"

class="
btn
btn-outline-primary
rounded-4
"

>

View

</a>


@if(

auth()->id()

!=

$user->id

)

<form

method="POST"

action="{{

route(

'admin.users.ban',

$user

)

}}"

>

@csrf

@method('PATCH')

<button

class="
btn

{{

$user->is_banned

?

'btn-success'

:

'btn-danger'

}}

rounded-4
"

>

{{

$user->is_banned

?

'Unban'

:

'Ban'

}}

</button>

</form>

@endif

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>



<div class="mt-4">

{{ $users->links() }}

</div>

</div>

</x-app-layout>
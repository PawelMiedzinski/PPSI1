<x-app-layout>

<div
class="
container
py-5
"
style="
max-width:720px;
"
>

<div
class="
card
border-0
shadow-lg
rounded-5
"
>

<div
class="
card-body
p-5
"
>

<div
class="
text-center
mb-5
"
>

<h1
class="
fw-bold
mb-3
"
>

Leave Review

</h1>

<p
class="
text-secondary
mb-0
"
>

{{

$rental
->item
->title

}}

</p>

</div>


<form

method="POST"

action="{{ route(

'reviews.store'

) }}"

>

@csrf


<input

type="hidden"

name="rental_id"

value="{{

$rental->id

}}"

>


<input

type="hidden"

name="rating"

id="ratingInput"

required

>


<div
class="
d-flex
justify-content-center
mb-5
"
>

<div
id="stars"

class="
d-flex
gap-3
"
>

@for($i=1;$i<=5;$i++)

<span

class="star"

data-value="{{ $i }}"

style="

font-size:52px;

cursor:pointer;

color:#d1d5db;

transition:.15s;

user-select:none;

transform:scale(1);

"

>

★

</span>

@endfor

</div>

</div>



<div class="mb-4">

<label
class="
fw-semibold
mb-3
"
>

Comment

</label>

<textarea

name="comment"

rows="6"

required

placeholder="Share your experience..."

class="
form-control
rounded-4
p-3
"

style="

resize:none;

font-size:16px;

"

></textarea>

</div>



<button

class="
btn
btn-primary
btn-lg
rounded-4
w-100
fw-bold
py-3
"

>

Submit Review

</button>

</form>

</div>

</div>

</div>



<script>

const stars=

document.querySelectorAll(

'.star'

);

const input=

document.getElementById(

'ratingInput'

);

let selected=0;


function paint(

value

){

stars.forEach(

star=>{

const current=

parseInt(

star.dataset.value

);

star.style.color=

current<=value

? '#fbbf24'

: '#d1d5db';


star.style.transform=

current<=value

? 'scale(1.08)'

: 'scale(1)';

}

);

}


stars.forEach(

star=>{

const value=

parseInt(

star.dataset.value

);


star.addEventListener(

'mouseenter',

()=>{

paint(

value

);

}

);


star.addEventListener(

'mouseleave',

()=>{

paint(

selected

);

}

);


star.addEventListener(

'click',

()=>{

selected=

value;

input.value=

value;

paint(

value

);

}

);

}

);

</script>

</x-app-layout>
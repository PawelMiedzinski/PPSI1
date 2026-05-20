import './bootstrap';
import 'bootstrap';

import Alpine from 'alpinejs';
import TomSelect from 'tom-select';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener(

'load',

()=>{

document

.querySelectorAll(

'.form-select'

)

.forEach(

(el)=>{

if(

!el.tomselect

){

new TomSelect(

el,

{

create:false

}

);

}

}

);

}

);
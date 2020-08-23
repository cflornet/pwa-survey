let name = localStorage.getItem('usr_name');
let id = localStorage.getItem('usr_id');

document.querySelector('.profile .name').innerHTML = name;
document.querySelector('.profile .id').innerHTML = id;
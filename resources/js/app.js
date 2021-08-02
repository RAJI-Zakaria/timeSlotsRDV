require('./bootstrap');


function displayById(anchor){
    window.location.href = '/medicament/'+anchor;
}

function display_TimeSlot(anchor){
    window.location.href = '/TimeSlot/'+anchor;
}


function anchor(anchor, lien){
    window.location.href = lien+anchor;
}
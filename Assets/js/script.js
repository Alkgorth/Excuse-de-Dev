
function pageLostRedirection() {
    if (document.body.id === 'lost-page') {
        
        setTimeout(function () {
          window.location.href = "/";
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    pageLostRedirection();
    
})
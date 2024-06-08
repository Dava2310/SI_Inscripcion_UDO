document.querySelectorAll('li').forEach(function(el) {
    if(el.querySelector('ul.submenu')) {
        el.addEventListener('mouseover', function() {
            this.querySelector('ul.submenu').style.display = 'block';
        });
        el.addEventListener('mouseout', function() {
            this.querySelector('ul.submenu').style.display = 'none';
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.burger');
    const ulHeader = document.querySelector('#ulHeader');

    burger.addEventListener('click', function() {
        console.log('coucou')
        document.getElementById('ulHeader').classList.toggle('active');
    });
});
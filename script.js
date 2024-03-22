let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}
document.addEventListener('DOMContentLoaded', function() {
    // Trigger typing animation
    const typingAnimation = document.getElementById('typing-animation');
    typingAnimation.style.animationPlayState = 'running';
});
window.onload = function() {
    window.location.href = '#home';
};
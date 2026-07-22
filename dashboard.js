// ============================
// Dashboard JavaScript
// ============================

// Welcome Alert
window.onload = function () {
    console.log("Welcome to SecretCoder Dashboard");
};


// Sidebar Active Menu

const menuItems = document.querySelectorAll(".menu li");

menuItems.forEach(item => {

    item.addEventListener("click", function () {

        menuItems.forEach(i => i.classList.remove("active"));

        this.classList.add("active");

    });

});


// Search Bar

const search = document.getElementById("search");

if(search){

search.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

console.log(value);

});

}


// Notification Bell

const bell = document.querySelector(".fa-bell");

if(bell){

bell.addEventListener("click", function(){

alert("No New Notifications");

});

}


// Logout Confirmation

const logout = document.querySelector(".logout");

if(logout){

logout.addEventListener("click", function(e){

if(!confirm("Are you sure you want to Logout?")){

e.preventDefault();

}

});

}


// Counter Animation

const counters = document.querySelectorAll(".counter");

counters.forEach(counter => {

counter.innerText = "0";

const updateCounter = () => {

const target = +counter.getAttribute("data-target");

const c = +counter.innerText;

const increment = target / 100;

if(c < target){

counter.innerText = Math.ceil(c + increment);

setTimeout(updateCounter,20);

}
else{

counter.innerText = target;

}

};

updateCounter();

});


// Scroll to Top

const topBtn = document.getElementById("topBtn");

if(topBtn){

window.onscroll=function(){

if(document.body.scrollTop>100 || document.documentElement.scrollTop>100){

topBtn.style.display="block";

}
else{

topBtn.style.display="none";

}

};

topBtn.onclick=function(){

window.scrollTo({

top:0,

behavior:"smooth"

});

};

}


// Current Date

const today=document.getElementById("today");

if(today){

const date=new Date();

today.innerHTML=date.toDateString();

}
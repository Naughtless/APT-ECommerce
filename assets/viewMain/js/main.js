//menu appear when clicked
const Menu = (a,b)=>{
    const toggle = document.getElementById(a),
    nav = document.getElementById(b)

    if(toggle && nav){
        toggle.addEventListener('click', ()=>{ 
            nav.classList.toggle('view')
        })
    }
}
Menu('nav-bd',"nav-menu");

/*menu dissapeared when chosen*/
const link = document.querySelectorAll('.nav-link'),
    menu = document.getElementById('nav-menu')

function removeMenu(){
    menu.classList.remove('view')
}

link.forEach(x=> x.addEventListener('click', removeMenu))

/*menu have dot below it*/
const sections = document.querySelectorAll('section[id]')
window.addEventListener('scroll', scrollMenu);

function scrollMenu(){
    const scrolls = window.pageYOffset
    sections.forEach(x=> {
        const height = x.offsetHeight
        const top = x.offsetTop - 50
        const sectionId = x.getAttribute('id')

        if(scrolls > top && scrolls <= top + height){
            document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.add('appear');
        } else {
            document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.remove('appear');
        }
    })
}

/*change color for header*/
window.onscroll = ()=>{
    const a = document.getElementById('header')
    if(this.scrolls >= 200) a.classList.add('h-scroll');
    else a.classList.remove('h-scroll');
}

//CART
/*cart appear and disappear*/
let cartIcon = document.querySelector(".nav-cart");
let cart =  document.querySelector(".cart");
let closeCartIcon = document.querySelector("#close-cart");

cartIcon.onclick =  () => {
    cart.classList.add("active");
}

closeCartIcon.onclick = () => {
    cart.classList.remove("active");
}

if (document.readyState == "loading"){
    document.addEventListener("DOMContentLoaded", go);
} else {
    go();
}
/*cart total, quantity*/
function go(){
    let quantity =  document.querySelectorAll('.cart-quantity');
    let x=0;
    for (let x=0; x < quantity.length; x++){
        let num = quantity[x];
        num.addEventListener('change', quantityChanged);
    }

/*add to cart*/
    let addToCart = document.getElementsByClassName("featured-button");
    for (let x=0; x < addToCart.length; x++){
        let prod = addToCart[x];
        prod.addEventListener('click', addToCartClicked);
    }

/*checkout*/
    document.getElementsByClassName("cart-button")[0].addEventListener('click', checkoutClicked);
}

function addToCartClicked(event){
    let add = event.target;
    let product = add.parentElement;
    let title = product.getElementsByClassName("featured-name")[0].innerText;
    let price = product.getElementsByClassName("featured-price")[0].innerText;
    let img = product.getElementsByClassName("featured-img")[0].src;
    addProduct(title, price, img);
    cartTotal();
}

function addProduct(title, price, img){
    let cart = document.createElement("div");
    cart.classList.add("cart-box");
    let item = document.getElementsByClassName("cart-content")[0];
    let name = item.getElementsByClassName("cart-prod");
    let x;
    for (x=0; x < name.length; x++){
        if (name[x].innerText == title){
            alert("Already added to cart!");
            return;
        }
    }

    let content = `<img src="${img}" alt="" class="cart-img">
                <div class="cart-detail">
                    <div class="cart-prod">${title}</div>
                    <div class="cart-price">${price}</div>
                    <input type="number" value="1" class="cart-quantity">
                </div>

                <i onclick ="return this.parentNode.remove();" class='bx bxs-trash-alt delete-cart'></i>`;
    cart.innerHTML = content;
    item.append(cart);
    cart.querySelector(".cart-quantity").addEventListener('change', quantityChanged);
}

function quantityChanged(event) {
    let num = event.target;
    if (isNaN(num.value) || num.value <=0){
        num.value=1;
    }
    cartTotal();
}

function checkoutClicked(){
    alert('Your order is placed.');
    var content = document.getElementsByClassName('cart-content')[0];
    while (content.hasChildNodes()){
        content.removeChild(content.firstChild);
    }
    cartTotal();
}

/*TOTAL PRICE*/
function cartTotal() {
    let cartProd = document.querySelector(".cart-content");
    let cartBox = cartProd.querySelectorAll(".cart-box");
    let total =0
    let x;
    for (x=0; x < cartBox.length; x++){
        let box = cartBox[x]
        let prodPrice =  box.querySelector(".cart-price");
        let prodQuantity = box.querySelector(".cart-quantity");
        let price = parseFloat(prodPrice.innerText.replace("$", ""))
        let quantity = prodQuantity.value
        total = total + (price*quantity)
    }
    total = Math.round(total * 100)/100;
    document.querySelector(".total-price").innerText = '$' + total;
}

/*change color for shoe size*/
const sizes = document.querySelectorAll('.size__shoe')
const colors = document.querySelectorAll('.prodinfo__color')
const product = document.querySelectorAll('.product-img')

function changeSize(){
    sizes.forEach(size => size.classList.remove('active1'))
    this.classList.add('active1')
}

function changeColor(){
    let primary = this.getAttribute('primary')
    let secondary = this.getAttribute('secondary')
    let color = this.getAttribute('color')
    let productColor = document.querySelector(`.product-img[color="${color}"]`)

    colors.forEach(c => c.classList.remove('active'))
    this.classList.add('active')

    document.documentElement.style.setProperty('--primary', primary)
    document.documentElement.style.setProperty('--secondary', secondary)

    product.forEach(p => p.classList.remove('shows'))
    productColor.classList.add('shows')
}

sizes.forEach(size => size.addEventListener('click', changeSize))
colors.forEach(c => c.addEventListener('click', changeColor))

/*Error Warning for Login*/

const loginbtn = document.querySelector('.loginbutton');
const email = document.querySelector('#email');
const password = document.querySelector('#pw');

loginbtn.addEventListener('click', () =>{
    if(!email.value.length && !password.value.length){
        showAlert('Please fill in the login form.');
    }
    else if(!email.value.length){
        showAlert('Email invalid, please try again.');
    }
    else if(!password.value.length){
        showAlert('Password invalid, please try again.');
    }
    else{
        //submit
    }
})

const showAlert = (msg) =>{
    let alertBox= document.querySelector('.error');
    let alertMsg = document.querySelector('.error-msg');
    alertMsg.innerHTML = msg;
    alertBox.classList.add('show');


}
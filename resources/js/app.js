import './bootstrap';

import { createApp } from 'vue';
import '../css/app.css';

function parseCurrency(value) {
    return Number(value.substring(1).replace(',', ''));
}

function formatCurrency(value) {
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    return formatter.format(value);
}

function setCart(cart) {
    localStorage['cart'] = JSON.stringify(cart);
    window.dispatchEvent(new Event('cartchange'));
}

window.fetchCartDetails = () => {
    axios.post('/api/cart', { cart: parseCart() })
        .then(response => {
            window.dispatchEvent(new CustomEvent('cartdetails', {
                detail: { data: response.data }
            }));
        });
};

window.updateCartDetails = (cart) => {
    let items = [];
    let total = 0;

    for (const [productId, quantity] of Object.entries(parseCart())) {
        let item = cart.items.find(item => item.product.id == productId);
        if (!item) {
            fetchCartDetails();
            return;
        }

        const itemTotal = quantity * parseCurrency(item.product.price);

        item.quantity = quantity;
        item.total = formatCurrency(itemTotal);

        total += itemTotal;

        items.push(item);
    }

    cart.items = items;
    cart.total = formatCurrency(total);
};

window.parseCart = () => {
    if (!localStorage.hasOwnProperty('cart')) {
        setCart({});
        return {};
    }

    try {
        return JSON.parse(localStorage['cart']);
    } catch (e) {
        return {};
    }
};
window.clearCart = () => {
    setCart({});
};

window.addToCart = (productId) => {
    const key = String(productId);
    let cart = parseCart();

    if (cart.hasOwnProperty(key)) {
        cart[key]++;
    } else {
        cart[key] = 1;
    }

    setCart(cart);
};

window.removeFromCart = (productId) => {
    const key = String(productId);
    let cart = parseCart();

    if (cart.hasOwnProperty(key) && cart[key] > 0) {
        cart[key]--;

        if (cart[key] == 0) {
            delete cart[key];
        }
    }

    setCart(cart);
};

window.changeCartProductCount = (productId, value) => {
    const key = String(productId);
    let cart = parseCart();

    cart[key] = parseInt(value);

    setCart(cart);
}

import Navbar from './components/Navbar.vue';
import Cart from './components/Cart.vue';
import AuthForm from './components/AuthForm.vue';
import Product from './components/Product.vue';
import Products from './components/Products.vue';
import SignIn from './components/SignIn.vue';
import SignUp from './components/SignUp.vue';
import Checkout from './components/Checkout.vue';
import Description from './components/Description.vue';
import Contact from './components/Contact.vue';
import Ordered from './components/Ordered.vue';
import AdminLayout from './components/AdminLayout.vue';
import AdminProducts from './components/AdminProducts.vue';
import AdminOrders from './components/AdminOrders.vue';
import AdminUsers from './components/AdminUsers.vue';
import CreateProduct from './components/CreateProduct.vue';
import DeleteProduct from './components/DeleteProduct.vue';

const app = createApp({});

app.config.globalProperties.csrf = () => {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
};

app.component('navbar', Navbar);
app.component('cart', Cart);
app.component('auth-form', AuthForm);
app.component('product', Product);
app.component('products', Products);
app.component('sign-in', SignIn);
app.component('sign-up', SignUp);
app.component('checkout', Checkout);
app.component('description', Description);
app.component('contact', Contact);
app.component('ordered', Ordered);
app.component('admin-layout', AdminLayout);
app.component('admin-products', AdminProducts);
app.component('admin-orders', AdminOrders);
app.component('admin-users', AdminUsers);
app.component('create-product', CreateProduct);
app.component('delete-product', DeleteProduct);

app.mount('#app');

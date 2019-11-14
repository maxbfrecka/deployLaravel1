
import Albums from './components/Albums.vue'
import Album from './components/Album.vue'
import Cart from './components/Cart.vue'
import Checkout from './components/Checkout.vue'
import StripeCheckout from './components/Checkout.vue'
import VueCart from './components/VueCart.vue'

export default [
    {
        path:'/vuecart',
        component: VueCart,
        name: 'vue-cart',
        props:true    
    },
    {
        path: '/albums/:catalogID',
        name: 'AlbumVue',
        component: Album
    },
    {
        path: '/', 
        component:Albums,
        props:true,
    },
    {
        path:'/vcart', 
        name: 'vcart',
        component:Cart,
        props:true,
    },
    {
        path:'/checkout', 
        name: 'checkout',
        component:Checkout,
        props:true,
    },
    {
        path:'/stripecheckout', 
        name: 'stripe-checkout',
        component:StripeCheckout,
        props:true,
    },
]

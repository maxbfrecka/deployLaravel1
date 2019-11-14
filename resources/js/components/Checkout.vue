<template>
    <div class="container cart-container">
        <h1>Checkout</h1>
        <div class="checkout-items" v-if="cartSize>0">
            <div v-for="item in getStoreCart" v-bind:key="item.id">
                <cart-item v-bind:item="item"></cart-item>
            </div>
        </div>

        <div class="bg-teal-300" >
            <h3>{{getSubtotal}}</h3>
            <h3>{{getTax}}</h3>
            <h3>{{getTotal}}</h3>
        </div>

        <div class="form-group">
            <!-- I NEED TO INPUT THE VALUES -->
    <form action="api/checkout" method="POST"  id="payment-form">
            
            <div class="form-group">
                <label>Email (We'll send your receipt here)</label>
                <input type="email" name="email" id="email" value="" required>
                <div class="form-group">
                    <label>Would you like us to email you when we release new music?</label>
                    <input type="checkbox">
                </div>
            </div>

            <div class="form-group">
                <label>Name on Card</label>
                <input type="text" name="name" id="name-on-card" value="" required>
                <label>Address Line 1</label>
                <input type="text" name="address" id="address" value="" required>
                <label>Address Line 2</label>
                <input type="text" name="address2" value="" >
                <label>City</label>
                <input type="text" name="city" id="city" value="" required>
                <label>State</label>
                <input type="text" name="state" id="state" value="" required>
                <label>ZIP Code</label>
                <input type="text" name="zip" id="zip" value="" required>
                <label>Country</label>
                <input type="text" name="country" value="" required>
            </div>
            
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" style="width: 30em">
                <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert" style="width: 30em"></div>
            </div>
            <!-- method to call for hidden full purchase links    
            <input type="hidden" name="fullpurchaseURL" value=""> -->
            <button class="button-primary" action="submit" id="complete-order">Submit Order</button>
        </form>

    </div>
        
    </div>
</template>

<script>
    export default {
        name:'vue-cart',
        props : [],
        data(){
            return  {
                taxRate:.10,
                // you need to add the csrf in the form above
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        computed: {
            getSessionTest: function(){
                console.log('get session test:')
                console.log(this.$session.getAll())
                return this.$session.getAll()
            },
            getStoreCart: function(){
                return this.$store.state.cart
            },
            cartSize: function(){
                return _.size(this.$store.state.cart)
            },
            getSubtotal: function(){
                var subtotal =0
                this.$store.state.cart.forEach(item =>{
                    subtotal+=item.price
                })
                return subtotal
            },
            getTax: function(){
                var totalTax =0
                this.$store.state.cart.forEach(item =>{
                    totalTax += item.price*this.taxRate
                })
                return totalTax
            },
            getTotal: function(){
                return this.getTax+this.getSubtotal
            }
        },
        components: {
        },
        methods: {
            removeItem(item){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                var newCart = _.without(this.$store.state.cart, item)
                this.$store.state.cart = newCart
            },
            emptyCart(){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                this.$store.state.cart = []
            }
        },
        created() {
        },
        mounted() {
            this.getSessionTest
            
            console.log('instripe')
            // Create a Stripe client.
            var stripe = Stripe('pk_test_8Wv3HfyAzaWbe2hMDl5hU4w50037hKM5S9');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode:true,
            });
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                //to prevent user from double clicking and submitting multiple charges
                document.getElementById('complete-order').disabled=true;

            var options = {
                name: document.getElementById('name-on-card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('state').value,
                address_zip: document.getElementById('zip').value

            }

            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('complete-order').disabled=false;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();




            }
        },
        beforeUpdate(){
        }
    }
</script>
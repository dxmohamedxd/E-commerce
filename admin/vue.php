<?php
   include "init.php";

?>
   


<section class="container" id="app">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a href="#" class="nav-link" :class="{active:(selectedTab=='elect')}" @click="selectedTab='elect'">Electronics</a></li>
        <li class="nav-item"><a href="#" class="nav-link" :class="{active:(selectedTab=='cloth')}" @click="selectedTab='cloth'">Clothes</a></li>
        <li class="nav-item"><a href="#" class="nav-link" :class="{active:(selectedTab=='food')}" @click="selectedTab='food'">Food</a></li>
    </ul>

    <div v-show="selectedTab=='elect'">
        <h1>Electronics</h1>
    </div>
    <div v-show="selectedTab=='cloth'">
        <h1>Clothes</h1>
    </div>
    <div v-show="selectedTab=='food'">
        <h1>Food</h1>
    </div>

</section>

<script>
    var app = Vue.createApp({
        data(){
            return {
                selectedTab:'cloth'
            }
        }
    })

    app.mount("#app")
</script>

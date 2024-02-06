<script setup lang="ts">
import { ref } from 'vue';
import {router} from "@inertiajs/vue3";

defineProps({
    errors:{
        type:Object,
        
    },
});

const form=ref({
    email:"",
    password:"",
    remember:false

});

function submit(e){
    e.preventDefault();
    router.post("/login",form.value);
    
}

</script>
<template>
{{ errors }}
    <div class="bg-gray-200 h-screen flex justify-center items-center">
        <form 
            @submit="submit"
            class="p-4 bg-white shadow-md rounded-xl space-y-3 w-96">
            <div>
                <label class="label">Email</label>
                <input 
                    v-model="form.email"
                    class="w-full input input-primary" 
                    type="email" />
            </div>
            <div>
                <label class="label">Password</label>
                <input
                    v-model="form.password" 
                    class="w-full input input-primary" 
                    type="password" />
            </div>
            <div>
               
                <label  class="label flex justify-start gap-2"> 
                     <input  
                        v-model="form.remember"
                        class="checkbox checkbox-primary" type="checkbox" />
                        Remeber me</label>
            </div>
            <div class="flex justify-end items-center gap-3">
                <a class="link link-primary">Forgot Password</a>
                <button class="btn btn-primary" type="submit">Log in</button>
            </div>
        </form>
    </div>
</template>
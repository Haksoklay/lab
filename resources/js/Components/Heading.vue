<script setup>
import { computed,ref } from 'vue';


    // const props =defineProps(['text','size']);
    const props =defineProps({
        text:{
            type:String,
            required:true
        },
        size:{
            type:String,
            default:'large'
        }
    })

    const textSize =computed(()=>{
        if(props.size=='mediun'){
            return 'text-2xl'
        }else if (props.size=='large'){
            return 'text-4xl'
        }else if (props.size=='small'){
            return 'text-xl'
        }else{
            return 'text-3xl'
        }

    })

    // const number =ref(0)
    // const doubleNumber=computed(()=>{
    //     return number.value*2
    // });


</script>

<template>
    <!-- {{ doubleNumber }}
    <button class="mr-4" @click="number--">Decresment{{ number }}</button>
    <button  @click="number++">Increment{{ number }}</button> -->

    <h1 :class="textSize">
        {{ text }}
    </h1>

</template>